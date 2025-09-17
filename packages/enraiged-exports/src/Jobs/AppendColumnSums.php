<?php

namespace Enraiged\Exports\Jobs;

use Enraiged\Exports\Models\Export;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\SerializesModels;
use PhpOffice\PhpSpreadsheet\IOFactory;

class AppendColumnSums implements ShouldQueue
{
    use Dispatchable, Queueable, SerializesModels;

    /** @var  array  The columns requiring sums. */
    protected array $columns;

    /** @var  object  The export model. */
    protected Export $export;

    /** @var  string  The PhpSpreadsheet writer type. */
    protected string $writer;

    /**
     *  Create an instance of this job.
     *
     *  @param  \Enraiged\Exports\Models\Export  $export
     *  @param  array   $columns
     *  @param  string  $writer
     *  @return void
     */
    public function __construct(Export $export, array $columns, string $writer = 'Xlsx')
    {
        $this->columns = $columns;
        $this->export = $export;
        $this->writer = $writer;
    }

    /**
     *  Handle this job.
     *
     *  @return void
     */
    public function handle()
    {
        if (count($this->columns)) {
            $formats = config('enraiged.tables.formats');
            $location = storage_path("app/{$this->export->file->path}");
            $spreadsheet = IOFactory::load($location);
            $highestrow = $spreadsheet->getActiveSheet()->getHighestRow();
            $activerow = $highestrow +1;

            foreach ($this->columns as $column => $format) {
                $first = "{$column}2";
                $final = "{$column}{$highestrow}";

                $activecell = "{$column}{$activerow}";

                $spreadsheet->getActiveSheet()->setCellValue($activecell, "=SUM({$first}:{$final})");
                $spreadsheet->getActiveSheet()->getStyle($activecell)->getFont()->setBold(true);

                if ($format) {
                    $spreadsheet->getActiveSheet()
                        ->getStyle($activecell)
                        ->getNumberFormat()
                        ->setFormatCode($formats[$format]);
                }
            }

            $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, $this->writer);
            $writer->save($location);
        }
    }
}
