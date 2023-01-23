<?php

namespace Enraiged\Users\Tables\Builders;

use Enraiged\Tables\Builders\TableBuilder;
use Enraiged\Tables\Contracts\ProvidesTableServices;
use Enraiged\Users\Models\User;
use Enraiged\Users\Services\IndexExporter;
use Enraiged\Users\Tables\Resources\IndexResource;

class UserIndex extends TableBuilder implements ProvidesTableServices
{
    /** @var  string  The exporter service. */
    protected $exporter = IndexExporter::class;

    /** @var  string  The data model. */
    protected string $model = User::class;

    /** @var  string  The model resource. */
    protected string $resource = IndexResource::class;

    /** @var  string  The template json file path. */
    protected string $template = __DIR__.'/../Templates/user-index.json';

    /**
     *  Provide the initial scoped query builder for this table.
     *
     *  @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        return User::reportable();
    }
}
