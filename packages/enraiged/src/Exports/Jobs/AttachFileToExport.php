<?php

namespace Enraiged\Exports\Jobs;

use Enraiged\Exports\Models\Export;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AttachFileToExport implements ShouldQueue
{
    use Dispatchable, Queueable, SerializesModels;

    /** @var  object  The export model. */
    protected $export;

    /** @var  object  The exportable parameters. */
    protected $exportable;

    /**
     *  Create an instance of this job.
     *
     *  @param  \Enraiged\Exports\Models\Export  $export
     *  @param  object  $exportable
     *  @return void
     */
    public function __construct(Export $export, object $exportable)
    {
        $this->export = $export;
        $this->exportable = $exportable;
    }

    /**
     *  Handle this job.
     *
     *  @return void
     */
    public function handle()
    {
        $this->export->file
            ->attach($this->exportable->filename, $this->exportable->location);

        $this->export->file->created_by = $this->exportable->created_by;
        $this->export->file->save();

        $this->export->status = 1;
        $this->export->save();
    }
}
