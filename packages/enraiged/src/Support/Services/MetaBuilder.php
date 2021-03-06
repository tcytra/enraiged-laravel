<?php

namespace Enraiged\Support\Services;

use Enraiged\Agreements\Models\Agreement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MetaBuilder
{
    /** @var  object  The metadata collection. */
    protected $meta;

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
     *  Create and return the application metadata against the provided request.
     *
     *  @param  \Illuminate\Http\Request  $request
     *  @return array
     */
    public function handle(Request $request): array
    {
        $this->request = $request;

        (object) $this
            ->appName()
            ->authParameters();

        return $this->meta
            ->merge(['language' => config('app.locale')])
            ->toArray();
    }

    /**
     *  Append the app name to the metadata collection.
     *
     *  @return self
     */
    private function appName()
    {
        $this->meta = $this->meta
            ->merge(['app_name' => config('app.name')]);

        return $this;
    }

    /**
     *  Append the app name to the metadata collection.
     *
     *  @return self
     */
    private function authParameters()
    {
        $this->meta = $this->meta
            ->merge([
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
                ]);
        }

        return $this;
    }
}
