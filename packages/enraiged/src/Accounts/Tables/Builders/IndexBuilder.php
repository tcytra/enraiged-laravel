<?php

namespace Enraiged\Accounts\Tables\Builders;

use Enraiged\Accounts\Services\IndexExporter;
use Enraiged\Accounts\Models\Account as Index;
use Enraiged\Accounts\Tables\Resources\IndexResource;
use Enraiged\Tables\Builders\TableBuilder;
use Enraiged\Tables\Contracts\ProvidesTableServices;

class IndexBuilder extends TableBuilder implements ProvidesTableServices
{
    /** @var  string  The exporter service. */
    protected $exporter = IndexExporter::class;

    /** @var  string  The data model. */
    protected $model = Index::class;

    /** @var  string  The model resource. */
    protected $resource = IndexResource::class;

    /** @var  string  The template json file path. */
    protected $template = __DIR__.'/../Templates/accounts-index.json';

    /**
     *  Provide the initial scoped query builder for this table.
     *
     *  @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        return Index::reportable();
    }
}
