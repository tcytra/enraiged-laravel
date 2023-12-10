<?php

namespace Enraiged\Support\Builders;

use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\PreconditionRequiredHttpException;

abstract class ActionBuilder
{
    use Security\AssertSecure,
        Security\RoleAssertions,
        Security\UserAssertions,
        Traits\ConfigurationHandler,
        Traits\EloquentModel,
        Traits\HttpRequest,
        Traits\ParameterLoader;

    /** @var  array|string  Perform a cleanup on the processed configuration. */
    protected $clean = ['action', 'permission', 'secure', 'secureAll', 'secureAny', 'uriIf', 'uriElse'];

    /**
     *  Create an instance of the TableBuilder.
     *
     *  @param  \Illuminate\Http\Request  $request
     *  @param  \Illuminate\Database\Eloquent\Model|string  $model
     *  @param  array   $parameters = []
     *  @return void
     */
    public function __construct(Request $request, $model, array $parameters = [])
    {
        (object) $this
            ->setModel($model)
            ->setParameters($parameters)
            ->setRequest($request);
    }

    /**
     *  Return the actions configuration.
     *
     *  @return array
     */
    public function actions(): array
    {
        return $this->get();
    }

    /**
     *  Perform a sanity check on the completed configuration.
     *
     *  @return self
     */
    protected function check()
    {
        if (config('app.debug')) {
            $redirect_default = collect($this->configuration)
                ->where('uri.redirect', 'default')
                ->count();

            $default_action = collect($this->configuration)
                ->where('default')
                ->count();

            if ($redirect_default > 0 && $default_action !== 1) {
                throw new PreconditionRequiredHttpException(__('exceptions.action.nodefault'));
            }
        }

        return $this;
    }

    /**
     *  Create and return the configuration against the provided request.
     *
     *  @return self
     */
    public function handle()
    {
        (object) $this
            ->fetch()
            ->process()
            ->clean()
            ->check();

        return $this;
    }

    /**
     *  Process the configuration.
     *
     *  @return self
     */
    protected function process()
    {
        $configuration = collect($this->configuration);

        if ($this instanceof Contracts\ShouldPreprocess) {
            $configuration = $configuration
                ->transform(fn ($item, $index) => $this
                    ->preprocess($this->request, $item, $index));
        }

        $configuration = $configuration
            ->filter(fn ($item) => $this->assertSecure($item, $this->model))
            ->filter(fn ($item, $index) => $this->checkPermission($item, $index, $this->model))
            ->transform(fn ($item) => $this->resolveUri($item));

        if ($this instanceof Contracts\ShouldPostprocess) {
            $configuration = $configuration
                ->transform(fn ($item, $index) => $this
                    ->postprocess($this->request, $item, $index));
        }

        $this->configuration = $configuration->toArray();

        return $this;
    }

    /**
     *  Create and return a configuration from the provided request and parameters.
     *
     *  @param  \Illuminate\Http\Request  $request
     *  @param  \Illuminate\Database\Eloquent\Model|string  $model
     *  @param  array   $parameters = []
     *  @return self
     *  @static
     */
    public static function From(Request $request, $model, array $parameters = []): self
    {
        $called = get_called_class();

        return (new $called($request, $model, $parameters))
            ->handle();
    }
}
