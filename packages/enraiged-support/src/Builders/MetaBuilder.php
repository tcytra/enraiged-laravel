<?php

namespace Enraiged\Support\Builders;

use App\Providers\RouteServiceProvider;
use Enraiged\Agreements\Models\Agreement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MetaBuilder
{
    /** @var  object  The metadata collection. */
    protected $meta;

    /** @var  array  The additional user provided parameters. */
    protected $parameters;

    /** @var  object  The request object. */
    protected $request;

    /**
     *  Create an instance of the MetaBuilder object.
     *
     *  @param  array   $meta
     *  @return void
     */
    public function __construct(array $meta = [])
    {
        $this->meta = collect($meta);
    }

    /**
     *  Return the meta array.
     *
     *  @return array
     */
    public function get(): array
    {
        return $this->meta
            ->merge($this->parameters)
            ->toArray();
    }

    /**
     *  Create and return the application metadata against the provided request.
     *
     *  @param  \Illuminate\Http\Request  $request
     *  @param  array   $parameters = []
     *  @return self
     */
    public function handle(Request $request, $parameters = []): self
    {
        $this->parameters = $parameters;
        $this->request = $request;

        (object) $this
            ->appParameters()
            ->authParameters();

        return $this;
    }

    /**
     *  Append the app parameters to the metadata collection.
     *
     *  @return self
     */
    protected function appParameters(): self
    {
        $this->meta = $this->meta
            ->merge([
                'app_home' => RouteServiceProvider::HOME,
                'app_host' => url(''),
                'app_name' => config('app.name'),
                'app_theme' => Auth::check() ? Auth::user()->theme : config('enraiged.theme.color'),
                'app_version' => 'Laravel v'.\Illuminate\Foundation\Application::VERSION.' (PHP v'.PHP_VERSION.')',
            ]);

        return $this;
    }

    /**
     *  Append the app date to the meta collection.
     *
     *  @return self
     */
    protected function authParameters(): self
    {
        $this->meta = $this->meta
            ->merge([
                'allow_login' => config('enraiged.auth.allow_login'),
                'allow_registration' => config('enraiged.auth.allow_registration'),
                'allow_secondary_credential' => config('enraiged.auth.allow_secondary_credential'),
                'allow_username_login' => config('enraiged.auth.allow_username_login'),
                'must_agree_to_terms' => require_agreement() ? Agreement::required()->pluck('type') : null,
                'must_complete_account' => null,
                'must_verify_email' => config('enraiged.auth.must_verify_email'),
            ]);

        if (Auth::check()) {
            $this->meta = $this->meta
                ->merge([
                    'has_agreed_to_terms' => null,
                    'has_completed_account' => null,
                    'has_verified_email' => $this->request->user()->hasVerifiedEmail(),
                ]);
        }

        return $this;
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
