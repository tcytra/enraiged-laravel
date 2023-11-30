<?php

namespace Enraiged\Tables\Support;

use Enraiged\Support\Collections\RequestCollection;

class TableRequestCollection extends RequestCollection
{
    /**
     *  Return the item if it exists in the collection.
     *
     *  @param  string  $key
     *  @return mixed|null
     */
    public function getFilter(string $key)
    {
        return $this->hasFilter($key)
            ? $this->get('filters')[$key]
            : null;
    }

    /**
     *  Determine if an item exists in the collection by key.
     *
     *  @param  string  $key
     *  @return bool
     */
    public function hasFilter(string $key): bool
    {
        return $this->has('filters')
            && key_exists($key, $this->get('filters'));
    }
}
