<?php

namespace Enraiged\Users\Models\Attributes;

use Enraiged\Agreements\Models\Agreement;

trait MustAgreeToTerms
{
    /**
     *  Initialize the trait.
     *
     *  @return void
     */
    public function initializeMustAgreeToTerms()
    {
        $config = config('enraiged.auth');

        if (key_exists('must_agree_to_terms', $config)) {
            $this->append(['has_agreed_to_terms', 'must_agree_to_terms']);
        }
    }

    /**
     *  Determine whether this user has agreed to terms.
     *
     *  @return bool|null
     */
    public function getHasAgreedToTermsAttribute(): ?bool
    {
        if (!$this->must_agree_to_terms || !count(Agreement::required())) {
            return null;
        }

        return count($this->unagreedTerms()) === 0;
    }

    /**
     *  Determine whether this user must be forced to agree to terms.
     *
     *  @return bool
     */
    public function getMustAgreeToTermsAttribute(): bool
    {
        if (!$this->exists || !$this->role) {
            return require_agreement();
        }

        $config = json_decode(json_encode( config('enraiged.auth.must_agree_to_terms') ));
        $default = false;

        if ($config === false || $config === true) {
            return $config;
        }

        if (!$config) {
            return $default;
        }

        if (property_exists($config, 'except_roles')) {
            return collect($config->except_roles)
                ->doesntContain($this->role->name);
        }

        if (property_exists($config, 'only_roles')) {
            return collect($config->only_roles)
                ->contains($this->role->name);
        }

        return $default;
    }

    /**
     *  Return an array of agreement types the user has not agreed to.
     *
     *  @return array
     */
    public function unagreedTerms(): array
    {
        if (config('enraiged.auth.must_agree_to_terms')) {
            $required_terms = Agreement::required()->pluck('type')->sort();
            $agreed_terms = $this->agreements->pluck('type')->sort();

            return array_diff($required_terms->toArray(), $agreed_terms->toArray());
        }

        return [];
    }
}
