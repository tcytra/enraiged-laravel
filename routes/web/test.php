<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('api/test/available', function (Request $request) {
    $available = collect([
        ['id' => 1, 'name' => 'Alyssa'],
        ['id' => 2, 'name' => 'Barbara'],
        ['id' => 3, 'name' => 'Cynthia'],
        ['id' => 4, 'name' => 'Dorothy'],
        ['id' => 5, 'name' => 'Ellie'],
        ['id' => 6, 'name' => 'Felicity'],
        ['id' => 7, 'name' => 'Giselle'],
    ]);

    if ($request->has('search')) {
        return response()
            ->json($available
                ->filter(fn ($each) => stripos($each['name'], $request->get('search')) !== false)
                ->values());
    }

    return response()
        ->json($available->toArray());
})->name('test.available');

//  Handle a request to preview the current theme (temporary).
Route::name('app.theme')
    ->get('theme/preview', fn ()
        => inertia('theme/Preview'));
