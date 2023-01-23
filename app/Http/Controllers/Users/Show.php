<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Enraiged\Users\Models\User;
use Enraiged\Users\Resources\UserManagementResource;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class Show extends Controller
{
    use AuthorizesRequests;

    /** @var  User  The user model. */
    protected $user;

    /**
     *  @param  \Illuminate\Http\Request  $request
     *  @param  \Enraiged\Users\Models\User  $user
     *  @return \Inertia\Response
     */
    public function __invoke(Request $request, User $user)
    {
        $this->user = preg_match('/^my\.profile/', $request->route()->getName())
            ? $request->user()
            : $user;

        $this->authorize('show', $this->user);

        return inertia('users/Show', [
            'actions' => [],
            'messages' => $this->messages(),
            'user' => UserManagementResource::from($this->user),
        ]);
    }

    /**
     *  Construct and return an array of the available page messages.
     *
     *  @return array
     */
    private function messages()
    {
        $messages = [];

        if ($this->user->is_myself) {
            array_push($messages, message('This is your personal user profile.'));
        } else

        if ($this->user->is_administrator) {
            array_push($messages, message('You are viewing this user profile as an administrator.', 'warn'));
        }

        return $messages;
    }
}
