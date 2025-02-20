<?php

namespace Enraiged\Support\Builders;

use Enraiged\Support\Collections\RouteCollection;

class UriBuilder
{
    protected $route;

    /** @var  array  The provided uri argument. */
    protected array|string $uri;

    /**
     *  @param  array|string  $uri
     *  @param  \Enraiged\Support\Collections\RouteCollection|\Illuminate\Routing\Route  $route
     */
    public function __construct($uri, $route = null)
    {
        $this->uri = $uri;
        $this->route = $route ?? request()->route();
    }

    /**
     *  @return string
     */
    protected function route($name, $params = []): string
    {
        return route($name, $params, config('enraiged.app.absolute_uris'));
    }

    /**
     *  Process the uri argument and return the result.
     *
     *  @return array|string
     */
    public function uri()
    {
        $uri = $this->uri;

        if (gettype($uri) === 'array') {
            $required_params = [];

            if (key_exists('param', $uri)) {
                array_push($required_params, $uri['param']);
            }
            if (key_exists('params', $uri)) {
                array_push($required_params, ...$uri['params']);
            }

            $params = $this->route->hasParameters()
                ? collect($this->route->parameters())
                    ->only($required_params)
                    ->transform(fn ($item) => $item instanceof \Illuminate\Database\Eloquent\Model
                        ? (int) $item->id
                        : $item)
                    ->toArray()
                : [];

            $route = $this->route($uri['route'], $params);

            $using_api = key_exists('api', $uri) && $uri['api'] === true;
            $using_method = key_exists('method', $uri) && strtoupper($uri['method']) !== 'GET';

            if ($using_api || $using_method) {
                $collect = [
                    'api' => $uri['api'] === true,
                    'method' => strtolower($uri['method']),
                    'route' => $route,
                ];

                if (key_exists('redirect', $uri)) {
                    $collect['redirect'] = $uri['redirect'];
                }

                return $collect;
            }

            return $route;
        }

        $params = $this->route->hasParameters()
            ? $this->route->parameters()
            : [];

        if (preg_match('/\./', $uri)) {
            return $this->route($uri, $params);
        }

        return '/'.trim($uri, '/');
    }

    /**
     *  Create an instance of the UriBuilder and return the result.
     *
     *  @param  array|string  $uri
     *  @param  \Enraiged\Support\Collections\RouteCollection|\Illuminate\Routing\Route  $route
     *  @return self
     */
    public static function From($uri, $route = null): self
    {
        return (new self($uri, $route));
    }
}
