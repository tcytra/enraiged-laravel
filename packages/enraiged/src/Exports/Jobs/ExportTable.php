<?php

namespace Enraiged\Exports\Jobs;

use Enraiged\Exports\Models\Export;
use Enraiged\Tables\Builders\TableBuilder;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

// use Maatwebsite\Excel\Excel;
// use Maatwebsite\Excel\Facades\Excel;

/**
 *  Warning: Incomplete! This was me getting a feel for this system, thinking it through.
 */
class ExportTable implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /** @var  object  The export model. */
    protected $export;

    /** @var  int  The total number of records to export. */
    protected $records;

    /** @var  object  The table builder object. */
    protected $table;

    /** @var  int  The number of records written to file. */
    protected $written;

    /**
     *  Create an instance of the TableExport object.
     *
     *  @param  \Enraiged\Tables\Builders\TableBuilder  $table
     *  @return void
     */
    public function __construct(TableBuilder $table)
    {
        $this->table = $table;
    }

    /**
     *  Handle this export job.
     *
     *  @return void
     */
    public function handle()
    {
        (object) $this
            ->build()
            ->count()
            ->write()
            ->finish();
    }

    //  Job Stages

    /**
     *  @return self
     */
    protected function build()
    {
        if (!$this->export) {
            (object) $this->table
                ->build()
                ->sort()
                ->filter()
                ->search();

            $this->export = (new Export)->fill([
                'hash' => $this->table->get('hashname'),
                'name' => $this->table->get('filename'),
                'rows' => 0,
                'status' => -1,
            ]);
        }

        return $this;
    }

    /**
     *  Ensure the job has a total records count.
     *
     *  @return self
     */
    protected function count()
    {
        if (!$this->records) {
            $this->records = $this->table->builder()->count();
        }

        $this->written = $this->export->rows;

        return $this;
    }

    /**
     *  Complete the job postprocessing.
     *
     *  @return self
     */
    protected function finish()
    {
        if ($this->written < $this->records) {
            // do it again...

        } else {
            $this->export
                ->fill(['status' => 1])
                ->save();
        }

        return $this;
    }

    /**
     *  Create the requested export document.
     *
     *  @return self
     */
    protected function write()
    {
        $exporter = $this->table->exporter();

        $limit = $this->table->get('chunksize');
        $start = $this->written;
        $batch = $this->table
            ->builder()
            ->offset($start)
            ->limit($limit);

        /*
        $success = Excel::store($batch, $this->table->exportpath());

        if ($success) {
            $this->written = $this->export->rows + count($batch);

            $this->export->fill(['rows' => $this->written]);
        }
        */

        return $this;
    }
}
