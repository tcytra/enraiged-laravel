<?php

namespace Enraiged\Users\Tables\Builders;

use Enraiged\Tables\Builders\TableBuilder;
use Enraiged\Tables\Contracts\ProvidesDefaultSort;
use Enraiged\Tables\Contracts\ProvidesTableQuery;
use Enraiged\Users\Models\User;
use Enraiged\Users\Tables\Exporters\IndexExporter;
use Enraiged\Users\Tables\Resources\IndexResource;
use Enraiged\Users\Traits\Assertions\AssertIsDeleted;
use Enraiged\Users\Traits\Assertions\AssertIsNotDeleted;
use Illuminate\Database\Eloquent\Builder;

class UserIndex extends TableBuilder implements ProvidesDefaultSort, ProvidesTableQuery
{
    use AssertIsDeleted, AssertIsNotDeleted;

    /** @var  string  The exporter service. */
    protected $exporter = IndexExporter::class;

    /** @var  string  The data model. */
    protected string $model = User::class;

    /** @var  string  The model resource. */
    protected $resource = IndexResource::class;

    /** @var  string  The template json file path. */
    protected string $template = __DIR__.'/../Templates/user-index.json';

    /**
     *  Apply default sort criteria to this table builder.
     *
     *  @return void
     */
    public function defaultSort()
    {
        $this->builder
            ->orderBy('profiles.first_name')
            ->orderBy('profiles.last_name');
    }

    /**
     *  Provide the initial query builder for this table.
     *
     *  @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(): Builder
    {
        //return $this->nonResourceBuild();

        $builder = User::reportable();

        if (!$this->request()->hasFilter('active')) {
            $builder->where('users.is_active', true);
        }

        return $builder;
    }

    /**
     *  This is for reference/demo; Handling builders without a laravel resource.
     *
     *  @return \Illuminate\Database\Eloquent\Builder
     *
    private function nonResourceBuild($columns): Builder
    {
        $avatars = url(config('enraiged.avatars.storage'));
        $columns = [
            'avatars.id as avatar',
            'avatars.color as avatar_color',
            'files.name as avatar_file_name',
            'profiles.first_name',
            'profiles.last_name',
            'roles.id as role_id',
            'roles.name as role_name',
            'users.created_at',
            'users.deleted_at',
            'users.id',
            'users.is_active',
            'users.email',
            'users.profile_id',
            "concat('{$avatars}/',avatars.id) as avatar_file_url",
            "concat(profiles.first_name, ' ', profiles.last_name) as profile_name",
        ];

        return User::selectRaw(collect($columns)->join(','))
            ->join('avatars', fn ($join) => $join->on('avatars.avatarable_id', '=', 'users.profile_id')
                ->where('avatars.avatarable_type', '=', config('enraiged.profiles.model')))
            ->join('profiles', 'profiles.id', '=', 'users.profile_id')
            ->join('roles', 'roles.id', '=', 'users.role_id')
            ->leftJoin('files', fn ($join) => $join->on('files.attachable_id', '=', 'avatars.id'))
                ->where('files.attachable_type', '=', config('enraiged.avatars.model'))
                ->orWhereNull('files.attachable_type')
            ->where('is_hidden', false);
    }*/
}
