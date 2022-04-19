<?php

namespace Enraiged\Files\Policies;

use App\Auth\User;
use Enraiged\Files\Models\File;
use Illuminate\Auth\Access\HandlesAuthorization;

class FilePolicy
{
    use HandlesAuthorization;

    public function delete(User $user, File $file)
    {
        return $user->id === $file->created_by;
    }

    public function show(User $user, File $file)
    {
        return $user->id === $file->created_by;
    }
}
