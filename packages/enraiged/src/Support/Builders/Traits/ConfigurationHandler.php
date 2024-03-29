<?php

namespace Enraiged\Support\Builders\Traits;

use Enraiged\Enums\FileTypes;
use Enraiged\Support\Builders\Enums\TemplateSources;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;
use Symfony\Component\HttpKernel\Exception\PreconditionFailedHttpException;

trait ConfigurationHandler
{
    /** @var  array  The configuration array of items. */
    protected array $configuration = [];

    /** @var  array|string  The configuration will except this/these item(s). */
    protected $except;

    /** @var  array|string  The configuration will include only this/these item(s). */
    protected $only;

    /** @var  string  The configuration source type. */
    protected $source;

    /** @var  string  The configuration template file location. */
    protected $template;

    /**
     *  Perform final cleanup in the processed configuration.
     *
     *  @return self
     */
    protected function clean()
    {
        if (property_exists($this, 'clean') && in_array(gettype($this->clean), ['array', 'string'])) {
            $this->configuration = collect($this->configuration)
                ->transform(fn ($item) => collect($item)
                    ->except($this->clean)
                    ->toArray())
                ->toArray();
        }

        return $this;
    }

    /**
     *  Return the configuration as a collection object.
     *
     *  @return \Illuminate\Support\Collection
     */
    public function collection(): Collection
    {
        return collect($this->configuration);
    }

    /**
     *  Retrieve the configuration from the specified source.
     *
     *  @return self
     */
    protected function fetch()
    {
        $configuration = null;

        if ($this->source === TemplateSources::Database) {
            //  todo
        }

        if ($this->source === TemplateSources::Filesystem) {
            $template = null;

            if (!$this->template) {
                throw new PreconditionFailedHttpException(__('exceptions.template.undefined'));
            }
            if (!File::exists($this->template)) {
                throw new PreconditionFailedHttpException(__('exceptions.template.missing'));
            }

            if (File::mimeType($this->template) === FileTypes::JSON) {
                $template = json_decode(file_get_contents($this->template), true);
                $configuration = json_decode(file_get_contents($this->template), true);
            }
            if (File::mimeType($this->template) === FileTypes::PHP) {
                $template = include $this->template;
            }

            if ($template) {
                $configuration = collect($template);
            }
        }

        if ($configuration) {
            if ($this->except) {
                $configuration = $configuration->except($this->except);
            }

            if ($this->only) {
                $configuration = $configuration->only($this->only);
            }

            $this->configuration = $configuration->toArray();
        }

        return $this;
    }

    /**
     *  Return the configuration array.
     *
     *  @return array
     */
    public function get(): array
    {
        return $this->configuration;
    }

    /**
     *  Return the configuration array without keys.
     *
     *  @return array
     */
    public function values(): array
    {
        return $this->collection()->values()->all();
    }
}
