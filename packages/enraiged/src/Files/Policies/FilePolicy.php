<?php

namespace Enraiged\Files\Policies;

use Enraiged\Files\Models\File;
use Enraiged\Users\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class FilePolicy
{
    use HandlesAuthorization;

    public function delete(User $user, File $file)
    {
        return $user->id === $file->created_by;
    }

    public function download(User $user, File $file)
    {
        return $user->id === $file->created_by;
    }
}
