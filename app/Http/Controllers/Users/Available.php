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
     *  @param  \App\Http\Requests\Users\AvailabilityRequest  $request
     *  @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(AvailabilityRequest $request)
    {
        $this->authorize('available', User::class);

        $columns = collect(['users.id', "concat(profiles.first_name, ' ', profiles.last_name) as name"])->join(',');
        $validated = collect($request->validated());

        $available = User::selectRaw($columns)
            ->join('profiles', 'profiles.id', '=', 'users.profile_id')
            ->join('roles', 'roles.id', '=', 'users.role_id')
            ->where('users.is_active', true)
            ->where('users.is_hidden', false);

        if ($validated->has('role_id')) {
            $available->where('role_id', $validated->get('role_id'));
        }

        if ($validated->has('search')) {
            $search = filter_var($validated->get('search'));
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

        $limit = $validated->get('limit') ?? 100;

        $available
            ->orderBy('name')
            ->limit($limit);

        return response()->json($available->get());
    }
}
