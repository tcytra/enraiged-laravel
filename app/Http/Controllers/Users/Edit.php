<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Enraiged\Avatars\Resources\AvatarEditResource;
use Enraiged\Users\Actions\Builders\ProfileActions;
use Enraiged\Users\Forms\Builders\EditForm;
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
        $user = $request->route()->user ?: $request->user();

        $this->authorize('edit', $user);

        $form = EditForm::from($request)
            ->edit($user, 'users.update');

        if ($user->isProtected()) {
            $form->disableField(['is_active', 'role_id']);
        }

        return inertia('users/Edit', [
            'actions' => ProfileActions::From($request, $user)->values(),
            'avatar' => AvatarEditResource::from($user->profile->avatar),
            'messages' => $this->messages($user),
            'template' => $form->template(),
            'user' => UserResource::from($user),
        ]);
    }

    /**
     *  Construct and return an array of the available page messages.
     *
     *  @param  \Enraiged\Users\Models\User  $user
     *  @return array
     */
    private function messages(User $user)
    {
        $messages = [];

        if ($user->deleted_at) {
            $datetime = date_create(datetimezone($user->deleted_at), new \DateTimeZone(timezone()));
            $formatter = new \IntlDateFormatter(language(), \IntlDateFormatter::FULL, \IntlDateFormatter::SHORT);
            $message = __('This user was deleted on :deleted', ['deleted' => $formatter->format($datetime)]);

            array_push($messages, message($message, 'error'));
        }

        if (!$user->is_myself && $user->is_administrator) {
            array_push($messages, message('You are updating these user details as an administrator.', 'warn'));
        }

        return $messages;
    }
}
