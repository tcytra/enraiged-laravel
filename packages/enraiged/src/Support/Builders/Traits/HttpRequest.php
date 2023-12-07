<?php

namespace Enraiged\Support\Builders\Traits;

use Enraiged\Support\Builders\UriBuilder;
use Enraiged\Support\Builders\Security\AssertCondition;
use Enraiged\Support\Collections\RequestCollection;
use Illuminate\Http\Request;

trait HttpRequest
{
    use AssertCondition;

    /** @var  RequestCollection  The http request in a collection wrapper. */
    protected RequestCollection $request;

    /**
     *  Determine whether the request user is permitted to perform an action on the model.
     *
     *  @param  array|object  $item
     *  @param  string  $index
     *  @param  \Illuminate\Database\Eloquent\Model|string  $model
     *  @return bool
     */
    protected function checkPermission($item, $index, $model): bool
    {
        $item = (object) $item;

        if (property_exists($item, 'permission') && $item->permission === true) {
            return true;
        }

        $action = property_exists($item, 'action')
            ? $item->action
            : $index;

        return $this->request()->user()->can($action, $model);
    }

    /**
     *  Get the request collection for the configuration.
     *
     *  @return \Enraiged\Support\Collections\RequestCollection
     */
    public function request(): RequestCollection
    {
        return $this->request;
    }

    /**
     *  Resolve the route for the provided uri argument.
     *
     *  @param  array   $item
     *  @return array
     */
    protected function resolveUri(array $item)
    {
        if (key_exists('uriIf', $item) && key_exists('condition', $item['uriIf'])) {
            if ($this->assertCondition($this->model, $item['uriIf']['condition'])) {
                $item['uri'] = $item['uriIf']['uri'];
            } else
            if (key_exists('uriElse', $item)) {
                $item['uri'] = $item['uriElse'];
            }
        }

        if (key_exists('uri', $item)) {
            $item['uri'] = UriBuilder::from($item['uri'], $this->request()->route())->uri();
        }

        return $item;
    }

    /**
     *  Set the builder request collection for the configuration.
     *
     *  @param  \Illuminate\Http\Request  $request
     *  @return self
     */
    public function setRequest(Request $request)
    {
        $this->request = RequestCollection::from($request);

        return $this;
    }

    /**
     *  Process a uri through the UriBuilder and return the result.
     *
     *  @param  string  $uri
     *  @return string
     */
    protected function uriBuilder($uri)
    {
        return UriBuilder::from($uri, $this->request()->route())->uri();
    }
}
