<?php

namespace App\Http\Controllers\Geo\Countries;

use App\Http\Controllers\Controller;
use Enraiged\Geo\Models\Country;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class Available extends Controller
{
    /**
     *  @param  \Illuminate\Http\Request  $request
     *  @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(Request $request): JsonResponse
    {
        $countries = Country::all()
            ->transform(fn ($country) => [
                'id' => $country->id,
                'name' => $country->name,
            ])
            ->toArray();

        return response()->json($countries);
    }
}
