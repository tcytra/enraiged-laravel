<?php

namespace Enraiged\Support\Collections\Traits;

trait Filled
{
    /**
     *  Determine if the specified item(s) from the collection has/have value.
     *
     *  @param  string|array  $key
     *  @return bool
     */
    public function filled($key)
    {
        $keys = is_array($key) ? $key : func_get_args();

        foreach ($keys as $key) {
            $value = $this->get($key);

            if (is_null($value)
            || (is_array($value) && !count($value))
            || (!is_bool($value) && trim((string) $value) === '')) {
                return false;
            }
        }

        return true;
    }
}
