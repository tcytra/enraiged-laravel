<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\AvailabilityRequest;
use Enraiged\Users\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Available extends Controller
{
    use AuthorizesRequests;

    /**
     *  @param  \Enraiged\Forms\Requests\AvailabilityRequest  $request
     *  @return \Illuminate\Http\Response
     */
    public function __invoke(AvailabilityRequest $request)
    {
        $this->authorize('available', User::class);

        $columns = collect(['users.id', "concat(profiles.first_name, ' ', profiles.last_name) as name"])->join(',');

        $available = User::selectRaw($columns)
            ->join('profiles', 'profiles.id', '=', 'users.profile_id')
            ->join('roles', 'roles.id', '=', 'users.role_id')
            ->where('users.is_hidden', false)
            ->where('roles.rank', '>=', $request->user->role->rank);

        if ($request->has('role_id')) {
            $available->where('role_id', $request->get('role_id'));
        }

        if ($request->has('search')) {
            $search = filter_var($request->get('search'));
            $terms = explode(" ", trim($search));

            $available->whereRaw("concat(profiles.first_name, ' ', profiles.last_name) like '{$search}%'");

            foreach ($terms as $term) {
                if (strlen($term) > 1) {
                    $available->orWhere(fn ($builder)
                        => $builder
                            ->where('profiles.first_name', 'like', "%{$term}%")
                            ->orWhere('profiles.last_name', 'like', "%{$term}%"));
                }
            }

            $available->orderByRaw("concat(profiles.first_name, ' ', profiles.last_name) like '{$search}%' desc");
        }

        $available
            ->orderBy('name')
            ->limit(100);

        return response()->json($available->get());
    }
}
