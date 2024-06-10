<?php

namespace Enraiged\Tables\Builders\Traits;

use Enraiged\Support\Builders\UriBuilder;
use Illuminate\Contracts\Queue\ShouldQueue;

trait Exportable
{
    /** @var  int  The exportable chunk size. */
    protected int $chunksize;

    /** @var  array  The exportable parameters. */
    protected $exportable;

     /** @var  string  The exported file location. */
    protected $exportpath;

     /** @var  string  The human readable filename. */
    protected $filename;

     /** @var  string  The exported file type. */
    protected $filetype;

    /** @var  string  The hashed (storage) filename. */
    protected $hashname;

    /**
     *  Return the export configuration.
     *
     *  @return array|null
     */
    protected function assembleExportableConfiguration()
    {
        if ($this->get('exportable') && (is_null($this->model) || $this->user->can('export', $this->model))) {
            $uri = UriBuilder::from($this->get('exportable')['uri'], $this->request()->route())->uri();

            return collect($this->get('exportable'))
                ->merge(['uri' => $uri])
                ->toArray();
        }

        return null;
    }

    /**
     *  Return the data sources for the searchable columns.
     *
     *  @return array
     */
    public function exportableColumns(): array
    {
        return collect($this->columns)
            ->filter(fn ($column)
                => (!key_exists('exportable', $column) || $column['exportable'] !== false)
                    && $this->assertSecure($column))
            ->transform(fn ($column) => $column['label'])
            ->toArray();
    }

    /**
     *  Return the human readable filename with filetype.
     *
     *  @return string
     */
    public function exportableFilename()
    {
        $filename = key_exists('name', $this->exportable)
            ? $this->exportable['name']
            : $this->id;
        $filetype = strtolower($this->request->get('export'));
        $datetime = datetimezone(now(), 'Y-m-d His');

        return "{$filename} {$datetime}.{$filetype}";
    }

    /**
     *  Return the exported file destination location.
     *
     *  @return string
     */
    public function exportableLocation()
    {
        $storage = config('enraiged.tables.storage');
        $filetype = strtolower($this->request->get('export'));
        $hashname = uhash();
        $exportpath = "{$storage}/{$hashname}.{$filetype}";

        return $exportpath;
    }

    /**
     *  Return the exporter service object.
     *
     *  @return object
     */
    public function exporter()
    {
        return $this->exporter::from($this);
    }

    /**
     *  Determine if the table export is handled by the queue.
     *
     *  @return bool
     */
    public function isQueuedExport(): bool
    {
        $exporter = $this->exporter;

        return $exporter
            && $exporter instanceof ShouldQueue
            && config('queue.default') !== 'sync';
    }
}
