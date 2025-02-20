<?php

namespace Enraiged\Support\Commands;

use Enraiged\Support\Filesystem;
use Illuminate\Console\Command;

class StorageClear extends Command
{
    /** @var  string  The name and signature of the console command. */
    protected $signature = 'storage:clear';

    /** @var  string  The console command description. */
    protected $description = 'Removes all app files from the storage directory.';

    /** @var  string  The storage path prefix to prepend to each clearable directory. */
    private $storage_path = 'app';

    /**
     *  Create an instance of the storage:clear console command.
     *
     *  @return void
     */
    public function __construct()
    {
        parent::__construct();

        $this->storage_path = trim($this->storage_path, '/');
    }

    /**
     *  Execute the console command.
     *
     *  @return int
     */
    public function handle(): int
    {
        if (app()->environment('production') && !$this->confirm('Application in production! Do you wish to continue?')) {
            return 1;
        }

        foreach (config('enraiged.storage.clear') as $each) {
            $storage_path = storage_path("{$this->storage_path}/{$each}");

            !is_dir($storage_path)
                || (new Filesystem)->cleanDirectory($storage_path, 'gitignore');
        }

        $this->info('Successfully cleared storage directories.');

        return 0;
    }
}
