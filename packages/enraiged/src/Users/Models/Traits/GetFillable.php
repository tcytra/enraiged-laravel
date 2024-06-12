<?php

namespace Enraiged\Users\Models\Traits;

trait GetFillable
{
    /**
     *  Get the fillable attributes for the model.
     *
     *  @return array
     */
    public function getFillable()
    {
        return [
            'created_by',
            'deleted_by',
            'email',
            'is_active',
            'language',
            'password',
            'profile_id',
            'role_id',
            'theme',
            'timezone',
            'updated_by',
        ];
    }
}
