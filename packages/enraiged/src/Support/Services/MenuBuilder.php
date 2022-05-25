<?php

namespace Enraiged\Support\Services;

use Enraiged\Support\Security\Traits\AssertSecure;
use Enraiged\Support\Security\Traits\RoleAssertions;
use Illuminate\Http\Request;

class MenuBuilder
{
    use AssertSecure,
        RoleAssertions;

    /** @var  object  The menu items collection. */
    protected $menu;

    /** @var  object  The request object. */
    protected $request;

    /**
     *  Create an instance of the MenuBuilder object.
     *
     *  @param array $menu
     *  @return void
     */
    public function __construct(array $menu)
    {
        $this->menu = collect($menu);
    }

    /**
     *  Create and return the application menu against the provided request.
     *
     *  @param  \Illuminate\Http\Request  $request
     *  @return array
     */
    public function handle(Request $request): array
    {
        $this->request = $request;

        (object) $this
            //->fetch() // todo: scatter the menu config across files for large apps? leverage db?
            ->secure()
            ->router();

        return $this->menu
            ->toArray();
    }

    /**
     *  Return the request.
     *
     *  @return \Illuminate\Http\Request
     */
    protected function request(): Request
    {
        return $this->request;
    }

    /**
     *  Secure the menu for the authenticated user.
     *
     *  @return mixed
     */
    protected function secure($menu = null)
    {
        $secured = ($menu ?: $this->menu)
            ->transform(function ($item) {
                if (key_exists('menu', $item)) {
                    $secure = $this->secure(collect($item['menu']));
                    
                    if ($secure->count()) {
                        $item['menu'] = $secure->toArray();
                        return $item;
                    }

                    return null;
                }

                return $item;
            })
            ->filter(function ($item) {
                if (!$item) {
                    return false;
                }

                return key_exists('secure', $item)
                    ? $this->assertSecure($item)
                    : true;
            });

        if ($menu) {
            return $secured;
        }

        $this->menu = $secured;

        return $this;
    }

    /**
     *  Translate complex route parameters for the authenticated user.
     *
     *  @return self
     *  @todo!
     */
    protected function router()
    {
        return $this;
    }
}
