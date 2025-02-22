<?php

namespace Enraiged\Support\Builders;

use Illuminate\Http\Request;

class MenuBuilder
{
    use Security\AssertSecure,
        Security\AuthAssertions,
        Security\RoleAssertions,
        Security\UserAssertions,
        Traits\ConfigurationHandler,
        Traits\HttpRequest,
        Traits\ParameterLoader;

    /** @var  array|string  Perform a cleanup on the processed configuration. */
    protected $clean = ['secure', 'secureAll', 'secureAny'];

    /**
     *  Create and return the configuration against the provided request.
     *
     *  @param  \Illuminate\Http\Request  $request
     *  @param  array   $parameters = []
     *  @return self
     */
    public function handle(Request $request, array $parameters = []): self
    {
        (object) $this
            ->setRequest($request)
            ->setParameters($parameters)
            ->fetch()
            ->process()
            ->clean();

        return $this;
    }

    /**
     *  Return the menu configuration.
     *
     *  @return array
     */
    public function menu(): array
    {
        return $this->get();
    }

    /**
     *  Process the configuration.
     *
     *  @return self
     */
    protected function process(): self
    {
        $configuration = collect($this->configuration);

        if ($this instanceof Contracts\ShouldPreprocess) {
            $configuration = $configuration
                ->transform(fn ($item, $index) => $this
                    ->preprocess($this->request, $item, $index));
        }

        $configuration = $this->secure($configuration);

        if ($this instanceof Contracts\ShouldPostprocess) {
            $configuration = collect($configuration)
                ->transform(fn ($item, $index) => $this
                    ->postprocess($this->request, $item, $index))
                ->toArray();
        }

        $this->configuration = $configuration;

        return $this;
    }

    /**
     *  Secure the configuration against the authenticated user.
     *
     *  @param  array|object  $items
     *  @return array
     */
    protected function secure($items): array
    {
        $configuration = collect($items)
            ->transform(function ($item) {
                if (key_exists('menu', $item)) {
                    $secure = $this->secure($item['menu']);

                    if (count($secure)) {
                        $item['menu'] = $secure;
                        return $item;
                    }

                    return null;
                }

                return $item;
            })
            ->filter(function ($item) {
                if (!$item) {
                    return false;
                }

                return $this->assertSecure($item);
            })
            ->toArray();

        return $configuration;
    }

    /**
     *  Create and return a configuration from the provided request and parameters.
     *
     *  @param  \Illuminate\Http\Request  $request
     *  @param  array   $parameters = []
     *  @return self
     *  @static
     */
    public static function From(Request $request, array $parameters = []): self
    {
        $called = get_called_class();

        return (new $called)
            ->handle($request, $parameters);
    }
}
