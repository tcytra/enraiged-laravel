<?php

namespace Enraiged\Exports\Jobs;

use Enraiged\Exports\Models\Export;
use Enraiged\Exports\Notifications\ExportComplete as ExportCompleteNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ExportComplete implements ShouldQueue
{
    use Dispatchable, Queueable, SerializesModels;

    /** @var  Export  The completed export model. */
    private $export;

    /**
     *  Create a new event instance.
     *
     *  @param  \Enraiged\Exports\Models\Export  $export
     *  @return void
     */
    public function __construct(Export $export)
    {
        $this->export = $export;
    }

    /**
     *  Handle this job.
     *
     *  @return void
     */
    public function handle()
    {
        $this->export->createdBy->notify(
            (new ExportCompleteNotification($this->export))
        );
    }
}
