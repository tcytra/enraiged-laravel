<?php

namespace App\Support;

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
            ->merge([
                'languages' => \App\Support\Enums\Languages::select(),
                'themes' => \App\Support\Enums\Themes::select(),
                'timezones' => \App\Support\Enums\Timezones::select(),
            ])
            ->toArray();
    }
}
