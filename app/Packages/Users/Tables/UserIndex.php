<?php

namespace App\Packages\Users\Tables;

use App\Packages\Users\Models\User;
use App\Packages\Users\Tables\Resources\IndexResource;
use Enraiged\Users\Tables\UserIndex as TableBuilder;
use Enraiged\Tables\Contracts\ProvidesTableQuery;
use Illuminate\Database\Eloquent\Builder;

class UserIndex extends TableBuilder implements ProvidesTableQuery
{
    /** @var  string  The data model. */
    protected string $model = User::class;

    /** @var  string  The model resource. */
    protected $resource = IndexResource::class;

    /** @var  string  The template json file path. */
    protected string $template = __DIR__.'/Templates/user-index.json';

    /**
     *  Provide the initial query builder for this table.
     *
     *  @return \Illuminate\Database\Eloquent\Builder
     */
    #[\Override]
    public function query(): Builder
    {
        $builder = $this->model::withTrashed()
            ->select('users.*')
            ->join('profiles', 'profiles.id', '=', 'users.profile_id')
            ->where('users.is_hidden', false);

        return $builder;
    }
}
