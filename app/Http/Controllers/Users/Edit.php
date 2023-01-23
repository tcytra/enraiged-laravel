<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Enraiged\Users\Forms\Builders\UpdateForm;
use Enraiged\Users\Models\User;
use Enraiged\Users\Resources\UserResource;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class Edit extends Controller
{
    use AuthorizesRequests;

    /** @var  User  The request user. */
    protected $user;

    /**
     *  @param  \Illuminate\Http\Request  $request
     *  @param  \Enraiged\Users\Models\User  $user
     *  @return \Inertia\Response
     */
    public function __invoke(Request $request, User $user = null)
    {
        $this->user = preg_match('/^my\.profile/', $request->route()->getName())
            ? $request->user()
            : $user;

        $this->authorize('edit', $this->user);

        $form = UpdateForm::from($request)
            ->edit($this->user, 'users.update');

        return inertia('users/Edit', [
            'messages' => $this->messages(),
            'template' => $form->template(),
            'user' => UserResource::from($this->user),
        ]);
    }

    /**
     *  Construct and return an array of the available page messages.
     *
     *  @return array
     */
    private function messages()
    {
        if (!$this->user->is_myself && $this->user->is_administrator) {
            return [message('You are updating these user details as an administrator.', 'warn')];
        }

        return [];
    }
}
