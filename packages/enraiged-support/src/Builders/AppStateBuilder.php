<?php

namespace Enraiged\Support\Builders;

use Enraiged\Support\Builders\MenuBuilder;
use Enraiged\Support\Builders\MetaBuilder;
use Enraiged\Users\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppStateBuilder
{
    /** @var  object  The appstate collection. */
    protected $state;

    /**
     *  Return the meta array.
     *
     *  @return array
     */
    public function get(): array
    {
        return $this->state;
    }

    /**
     *  Assemble the state data with the provided request.
     *
     *  @param  \Illuminate\Http\Request  $request
     *  @return self
     */
    public function handle(Request $request): self
    {
        $menu_parameters = [
            'source' => 'file',
            'template' => resource_path('seeds/appmenu.json'),
        ];

        $this->state = [
            'auth' => Auth::check() ? UserResource::from($request->user()) : null,
            'menu' => (new MenuBuilder)->handle($request, $menu_parameters)->get(),
            'meta' => (new MetaBuilder)->handle($request)->get(),
        ];

        return $this;
    }
}
