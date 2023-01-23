<?php

namespace Enraiged\Users\Models\Traits;

use Symfony\Component\HttpKernel\Exception\ConflictHttpException;

trait IsProtected
{
    public static function bootIsProtected()
    {
        self::deleting(function ($model) {
            if ($model->is_protected) {
                throw new ConflictHttpException(
                    __('This user is protected and cannot be deleted')
                );
            }
        });
    }
}
