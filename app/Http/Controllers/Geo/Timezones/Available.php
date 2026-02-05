<?php

namespace App\Http\Controllers\Geo\Timezones;

use App\Http\Controllers\Controller;
use DateTime;
use DateTimeZone;
use Enraiged\Geo\Enums\TimezoneIdentifier;
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
        if ($request->has('country_id')) {
            $country = Country::findOrFail($request->get('country_id'))->code;
            $timezones = DateTimeZone::listIdentifiers(DateTimeZone::PER_COUNTRY, $country);

        } else if ($request->has('region_id')) {
            $region = TimezoneIdentifier::from($request->get('region_id'));
            $timezones = DateTimeZone::listIdentifiers($region->value);

        } else {
            $timezones = DateTimeZone::listIdentifiers(DateTimeZone::ALL);
        }

        return response()
            ->json(
                collect($timezones)
                    ->transform(function ($timezone) {
                        $datetimezone = new DateTimeZone($timezone);
                        $datetime = new DateTime('now', $datetimezone);
                        $offset = sprintf("%+d", $datetime->getOffset() /60 /60);

                        return [
                            'id' => $timezone,
                            'name' => "(GMT{$offset}) {$timezone}"
                        ];
                    })
                    ->toArray()
            );
    }
}
