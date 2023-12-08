<?php

namespace Enraiged\Users\Models\Traits;

use Symfony\Component\HttpKernel\Exception\ConflictHttpException;

trait IsProtected
{
    /**
     *  @return bool
     */
    public function isProtected()
    {
        return $this->is_protected;
    }

    /**
     *  @return void
     */
    public static function bootIsProtected()
    {
        self::deleting(function ($model) {
            if ($model->is_protected) {
                throw new ConflictHttpException(__('exceptions.user.protected'));
            }
        });
    }
}
