<?php

namespace Enraiged\Support\Builders\Security;

use Illuminate\Support\Str;

trait AssertCondition
{
    /**
     *  Determine whether or not a provided condition can be true.
     *
     *  @param  \Illuminate\Database\Eloquent\Model  $model
     *  @param  array|object  $condition
     *  @return bool
     */
    protected function assertCondition($model, $condition): bool
    {
        $condition = (object) $condition;

        if (property_exists($condition, 'attribute')) {
            if (property_exists($model, $condition->attribute) || !is_null($model->{$condition->attribute})) {
                return $model->{$condition->attribute} === true;
            }
        }

        if (property_exists($condition, 'method')) {
            $method = preg_match('/^assert/', $condition->method)
                ? $condition->method
                : Str::camel("assert_{$condition->method}");

            if (method_exists($this, $method)) {
                return $this->{$method}($model) === true;
            }

            if (method_exists($model, $condition->method)) {
                return $model->{$condition->method}() === true;
            }
        }

        return false;
    }
}
