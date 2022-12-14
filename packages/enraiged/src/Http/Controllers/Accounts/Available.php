<?php

namespace Enraiged\Http\Controllers\Accounts;

use App\Http\Controllers\Controller;
use Enraiged\Accounts\Models\Account;
use Enraiged\Forms\Requests\AvailabilityRequest;
use Enraiged\Roles\Enums\Roles;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Available extends Controller
{
    use AuthorizesRequests;

    /**
     *  @param  \Illuminate\Http\Request  $request
     *  @return \Inertia\Response
     */
    public function __invoke(AvailabilityRequest $request)
    {
        $this->authorize('available', Account::class);

        $columns = [
            '`users`.`id`',
            "concat(`profiles`.`first_name`, ' ', `profiles`.`last_name`) as name",
        ];

        $available = Account::selectRaw(collect($columns)->join(','))
            ->join('profiles', 'profiles.id', '=', 'users.profile_id')
            ->join('roles', 'roles.id', '=', 'users.role_id')
            ->where('roles.rank', '<=', Roles::Associate)
            ->where('users.is_hidden', false);

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
