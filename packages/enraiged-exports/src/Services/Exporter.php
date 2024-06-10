<?php

namespace Enraiged\Exports\Services;

use Enraiged\Exports\Jobs\AttachFileToExport;
use Enraiged\Exports\Models\Export;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\App;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Excel;

//use Enraiged\Exports\Notifications\ExportDone; // todo

class Exporter implements FromQuery, ShouldAutoSize, WithColumnFormatting, WithHeadings, WithMapping
{
    use Exportable;

    /** @var  object  The table template builder. */
    protected $table;

    /**
     *  Create an instance of the exporter service.
     *
     *  @param  \Enraiged\Tables\Builders\TableBuilder  $table
     *  @return void
     */
    public function __construct($table)
    {
        $this->table = $table;
    }

    /**
     * @return array
     */
    public function columnFormats(): array
    {
        $columns = array_keys($this->table->exportableColumns());
        $formats = array_keys(config('enraiged.tables.formats'));
        $provide = [];

        for ($i = 0; $i < count($columns); $i++) {
            $column = $this->table->column($columns[$i]);

            if (key_exists('format', $column) && key_exists($column['format'], $formats)) {
                $index = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($i + 1);

                $provide[$index] = config('enraiged.tables.formats')[$column['format']];
            }
        }

        return $provide;
    }

    /**
     *  Return the column headings for the export.
     *
     *  @return array
     */
    public function headings(): array
    {
        return collect($this->table->exportableColumns())
            ->values()
            ->toArray();
    }

    /**
     *  Execute the export process.
     *
     *  @return \Enraiged\Exports\Models\Export
     */
    public function process()
    {
        $exportable = (object) [
            'created_by' => $this->table->user()->id,
            'filename' => $this->table->filename(),
            'location' => $this->table->exportpath(),
        ];

        $parameters = [
            'name' => $exportable->filename,
            'created_by' => $exportable->created_by,
        ];

        $this->export = Export::create($parameters);

        if ($this->table->isQueuedExport()) {
            $this->queue($exportable->location, null, $this->writer())
                ->chain([
                    new AttachFileToExport($this->export, $exportable),
                    //new ExportDone($this->export),
                ]);

        } else {
            $this->store($exportable->location, null, $this->writer());

            (new AttachFileToExport($this->export, $exportable))->handle();

            //(new ExportDone($this->export))->handle();
        }

        return $this->export;
    }

    /**
     *  Map the model to the export row.
     *
     *  @param  \Illuminate\Database\Eloquent\Model  $model
     *  @return array
     */
    public function map($model): array
    {
        $data = (object) $this->table
            ->resource($model)
            ->toArray(request());

        return collect($this->table->exportableColumns())
            ->keys()
            ->transform(fn ($key) => [$key => $data->{$key}])
            ->flatten()
            ->toArray();
    }

    /**
     *  Return the exportable query.
     *
     *  @return Builder|EloquentBuilder|Relation
     */
    public function query()
    {
        $table = clone $this->table;

        $query = method_exists($table, 'query')
            ? $table->query()
            : App::make($table->model)::query();

        (object) $table
            ->builder($query)
            ->sort()
            ->filter()
            ->search();

        return $this instanceof ShouldQueue
            ? $table->builder()
            : $table->builder()->get();
    }

    /**
     *  Return the selected writer type.
     *
     *  @return string
     */
    protected function writer()
    {
        $filetype = strtolower($this->table->get('filetype'));

        switch ($filetype) {
            case 'csv': return Excel::CSV;
            case 'xls': return Excel::XLS;
        }

        return Excel::XLSX;
    }
}
