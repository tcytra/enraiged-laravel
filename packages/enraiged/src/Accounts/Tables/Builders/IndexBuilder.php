<?php

namespace Enraiged\Accounts\Tables\Builders;

use Enraiged\Accounts\Services\IndexExporter;
use Enraiged\Accounts\Models\Index;
use Enraiged\Accounts\Tables\Resources\IndexResource;
use Enraiged\Tables\Builders\TableBuilder;
use Enraiged\Tables\Contracts\ProvidesTableServices;
use Enraiged\Tables\Traits\BuilderFrom;

class IndexBuilder extends TableBuilder implements ProvidesTableServices
{
    use BuilderFrom;

    /** @var  string  The exporter service. */
    protected $exporter = IndexExporter::class;

    /** @var  string  The data model. */
    protected $model = Index::class;

    /** @var  string  The model resource. */
    protected $resource = IndexResource::class;

    /** @var  string  The template json file path. */
    protected $template = __DIR__.'/../Templates/accounts_index.json';
}
