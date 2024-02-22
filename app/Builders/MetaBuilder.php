<?php

namespace App\Builders;

use Enraiged\Support\Builders\MetaBuilder as Builder;
use Illuminate\Http\Request;

class MetaBuilder extends Builder
{
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
            ->appParameters()
            ->authParameters();

        return $this->meta
            ->merge(['language' => config('app.locale')])
            ->merge(['themes' => \App\Enums\Themes::select()])
            ->toArray();
    }
}
