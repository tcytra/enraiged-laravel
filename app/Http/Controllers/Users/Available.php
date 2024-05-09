<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\AvailabilityRequest;
use Enraiged\Users\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Available extends Controller
{
    use AuthorizesRequests;

    /** @var  array  The columns required for the available options. */
    protected $columns = [
        'users.id',
        'users.profile_id',
        "concat(profiles.first_name, ' ', profiles.last_name) as name",
    ];

    /**
     *  @param  \App\Http\Requests\Users\AvailabilityRequest  $request
     *  @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(AvailabilityRequest $request)
    {
        $this->authorize('available', User::class);

        $validated = collect($request->validated());

        $available = User::selectRaw(collect($this->columns)->join(','))
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
        }

        $limit = $validated->get('limit') ?? 100;

        $available
            ->orderByRaw("concat(profiles.first_name, ' ', profiles.last_name)")
            ->limit($limit)
            ->get()
            ->transform(fn ($user)
                => $user->dropdownOption());

        return response()->json($available);
    }
}
