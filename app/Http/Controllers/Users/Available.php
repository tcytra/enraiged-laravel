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

        $columns = [
            '`users`.`id`',
            "concat(`profiles`.`first_name`, ' ', `profiles`.`last_name`) as name",
        ];

        $available = User::selectRaw(collect($columns)->join(','))
            ->join('profiles', 'profiles.id', '=', 'users.profile_id')
            ->join('roles', 'roles.id', '=', 'users.role_id')
            ->where('users.is_hidden', false);

        if ($request->has('role_id')) {
            $available->where('role_id', $request->get('role_id'));
        }

        if ($request->has('search')) {
            $search = $request->get('search');
            $wheres = [];

            foreach (explode(" ", trim($search)) as $term) {
                $term = filter_var($term);
                $searchable = collect(['profiles.first_name', 'profiles.last_name'])
                    ->transform(function ($column) use ($term) {
                        return "{$column} LIKE '%{$term}%'";
                    })
                    ->join(' OR ');

                $wheres[] = "({$searchable})";
            }

            $where = implode(' AND ', $wheres);

            $available->whereRaw("({$where})");
        }

        $available
            ->orderBy('name')
            ->limit(100);

        return response()->json($available->get());
    }
}
