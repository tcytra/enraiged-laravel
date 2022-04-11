<?php

namespace App\Auth\Traits;

use Symfony\Component\HttpKernel\Exception\ConflictHttpException;

trait IsProtected
{
    public static function bootIsProtected()
    {
        self::deleting(function ($model) {
            if ($model->is_protected) {
                throw new ConflictHttpException(
                    __('This account is protected and cannot be deleted')
                );
            }
        });
    }
}
