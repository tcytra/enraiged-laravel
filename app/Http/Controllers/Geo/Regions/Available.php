<?php

namespace App\Http\Controllers\Geo\Regions;

use App\Http\Controllers\Controller;
use Enraiged\Geo\Models\Region;
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
        if (!$request->has('country_id')) {
            return response()->json([]);
        }

        $regions = Region::where('country_id', $request->get('country_id'))
            ->get()
            ->transform(fn ($region) => [
                'id' => $region->id,
                'name' => $region->name,
            ])
            ->toArray();

        return response()->json($regions);
    }
}
