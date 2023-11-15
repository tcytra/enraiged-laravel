<?php

namespace App\Console\Enraiged;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Process;
use Illuminate\Support\Facades\Storage;

class FixSSR extends Command
{
    /** @var  string  The name and signature of the console command. */
    protected $signature = 'enraiged:fix-ssr {--revert}';

    /** @var  string  The console command description. */
    protected $description = 'Fix the Primevue packages for SSR usage.';

    /** @var  bool  An argument to execute a reversal. */
    protected $revert = false;

    /**
     *  Execute the console command.
     *
     *  @return void
     */
    public function handle(): void
    {
        $this->basepath = base_path('node_modules/primevue');
        $this->revert = $this->option('revert');

        (object) $this
            ->addPackageJsonType()
            ->applyIconsImportsFix()
            ->applyPackageImportsFix();

        $this->info('Done.');

        if (!$this->revert) {
            $this->info('Execute php artisan enraiged:fix-ssr --revert to reverse these changes.');
        }
    }

    /**
     *  This executes a sed to add the type: module line to the package.json files.
     *
     *  @return self
     */
    private function addPackageJsonType(): self
    {
        $this->line('Applying package.json fix...');

        $progress = $this->output->createProgressBar(1);
        $progress->start(1);

        $command = $this->revert
            ? "sed -i '/\"type\": \"module\",/d' {$this->basepath}/{icons/*,*}/package.json"
            : "find {$this->basepath}/*/ -type f -name 'package.json'  -exec sed -i '1 a\  \"type\": \"module\",' {} \;";

        Process::run($command);

        $progress->advance();
        $progress->finish();
        $this->newLine();

        return $this;
    }

    /**
     *  This executes a sed to expand the include call to the full *.esm.js package filename.
     *
     *  @return self
     */
    private function applyIconsImportsFix(): self
    {
        $this->line('Applying icons imports fix...');

        $directories = collect(Storage::disk('node')->directories('primevue/icons'));

        $progress = $this->output->createProgressBar($directories->count());

        $directories->each(function ($package) use ($progress) {
            $command = $this->revert
                ? "find {$this->basepath}/ -type f -name '*.esm.js' -exec sed -i \"s|'{$package}/index.esm.js'|'{$package}'|\" {} \;"
                : "find {$this->basepath}/ -type f -name '*.esm.js' -exec sed -i \"s|'{$package}'|'{$package}/index.esm.js'|\" {} \;";
            Process::run($command);

            $progress->advance();
        });

        $progress->finish();
        $this->newLine();

        return $this;
    }

    /**
     *  This executes a sed to expand the include call to the full *.esm.js filenames.
     *
     *  @return $this
     */
    private function applyPackageImportsFix(): self
    {
        $this->line('Applying package imports fix...');

        $directories = collect(Storage::disk('node')->directories('primevue'))
            ->filter(fn ($directory) => Storage::disk('node')->exists("{$directory}/package.json"));

        $progress = $this->output->createProgressBar($directories->count() + 2);

        $directories->each(function ($package_path) use ($progress) {
            $package_name = substr($package_path, strrpos($package_path, '/') +1);

            //  first we ensure we have a full filename call to the package
            $command = $this->revert
                ? "find {$this->basepath}/ -type f -name '*.esm.js' -exec sed -i \"s|'{$package_path}/{$package_name}.esm.js'|'{$package_path}'|\" {} \;"
                : "find {$this->basepath}/ -type f -name '*.esm.js' -exec sed -i \"s|'{$package_path}'|'{$package_path}/{$package_name}.esm.js'|\" {} \;";
            Process::run($command);

            //  then we ensure the package script has a full filename call to the local style
            $command = $this->revert
                ? "find {$this->basepath}/{$package_name}/ -type f -name '{$package_name}.esm.js' -exec sed -i \"s|''|''|\" {} \;"
                : "find {$this->basepath}/{$package_name}/ -type f -name '{$package_name}.esm.js' -exec sed -i \"s|'{$package_path}/style'|'{$package_path}/style/{$package_name}style.esm.js'|\" {} \;";
            Process::run($command);

            //  finally we ensure the local style script has a full filename call to the base style
            if (Storage::disk('node')->exists("{$package_path}/style/{$package_name}style.esm.js")) {
                $command = $this->revert
                    ? "find {$this->basepath}/{$package_name}/style/ -type f -name '{$package_name}style.esm.js' -exec sed -i \"s|'primevue/base/style/basestyle.esm.js'|'primevue/base/style'|\" {} \;"
                    : "find {$this->basepath}/{$package_name}/style/ -type f -name '{$package_name}style.esm.js' -exec sed -i \"s|'primevue/base/style'|'primevue/base/style/basestyle.esm.js'|\" {} \;";
                Process::run($command);
            }

            $progress->advance();
        });

        foreach (['basecomponent', 'basedirective'] as $each) {
            $command = $this->revert
                ? "find {$this->basepath}/{$each}/ -type f -name '{$each}.esm.js' -exec sed -i \"s|'primevue/base/style/basestyle.esm.js'|'primevue/base/style'|\" {} \;"
                : "find {$this->basepath}/{$each}/ -type f -name '{$each}.esm.js' -exec sed -i \"s|'primevue/base/style'|'primevue/base/style/basestyle.esm.js'|\" {} \;";
            Process::run($command);

            $progress->advance();
        }

        $progress->finish();
        $this->newLine();

        return $this;
    }
}
