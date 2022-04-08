<?php

namespace Enraiged\Accounts\Traits\Tables;

trait Columns
{
    /** @var  array  The table columns. */
    protected $columns = [
        'id' => ['label' => 'ID'],
        'name' => ['label' => 'Name'],
        'email' => ['label' => 'Email'],
        'created' => ['class' => 'text-right', 'label' => 'Created'],
    ];
}
