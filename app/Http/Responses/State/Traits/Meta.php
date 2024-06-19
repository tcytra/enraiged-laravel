<?php

namespace App\Http\Responses\State\Traits;

use App\Support\MetaBuilder;
use Illuminate\Http\Request;

trait Meta
{
    /**
     *  Build and return the application metadata.
     *
     *  @param  \Illuminate\Http\Request  $request
     *  @return array
     */
    private function meta(Request $request)
    {
        return (new MetaBuilder())
            ->handle($request);
    }
}
