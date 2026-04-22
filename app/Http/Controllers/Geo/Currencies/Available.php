<?php

namespace App\Http\Controllers\Geo\Currencies;

use App\Http\Controllers\Controller;
use Enraiged\Geo\Models\Currency;
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
        $currencies = Currency::query()
            ->where('is_active', true)
            ->get()
            ->transform(fn ($currency) => [
                'id' => $currency->id,
                'code' => $currency->code,
                'name' => $currency->name,
            ])
            ->toArray();

        return response()->json($currencies);
    }
}
