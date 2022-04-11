<?php

namespace App\Http\Requests\Accounts;

use Enraiged\Accounts\Models\Table as AccountTable;
use Enraiged\Accounts\Resources\Tables\IndexData;
use Enraiged\Support\Requests\TableRequest;

class IndexRequest extends TableRequest
{
    /** @var  array  The table actions. */
    protected $actions = [
        'show' => [
            'class' => 'p-btn-primary',
            'icon' => 'pi pi-eye',
            'method' => 'emit',
            'tooltip' => 'Show account',
        ],
        'edit' => [
            'class' => 'p-button-warning',
            'icon' => 'pi pi-pencil',
            'tooltip' => 'Edit account',
        ],
        'destroy' => [
            'class' => 'p-button-danger',
            'confirm' => 'Are you certain you wish to delete this account?',
            'icon' => 'pi pi-trash',
            'method' => 'delete',
            'tooltip' => 'Delete account',
        ],
    ];

    /** @var  array  The table columns. */
    protected $columns = [
        'id' => [
            'label' => 'ID',
        ],
        'first_name' => [
            'label' => 'First Name',
        ],
        'last_name' => [
            'label' => 'Last Name',
        ],
        'email' => [
            'label' => 'Email',
        ],
        'birthday' => [
            'class' => 'text-right',
            'label' => 'Birthday',
            'source' => 'profiles.birthdate',
        ], // 'select' => 'DATE_FORMAT("%Y%m", profiles.birthdate)',
        'created' => [
            'class' => 'text-right',
            'label' => 'Created',
        ],
    ];

    /** @var  string  The route prefix. */
    protected $route_prefix = 'accounts.';

    /** @var  string  The table name. */
    protected $table_name = 'accounts';

    /** @var  string  The uri for the table data request. */
    protected $uri = 'accounts.index.data';

    /**
     *  Return the data for the table request.
     *
     *  @return \Illuminate\Http\Resources\Json\ResourceCollection<\Illuminate\Http\Resources\Json\AnonymousResourceCollection>
     */
    public function data()
    {
        $builder = AccountTable::query()
            ->join('profiles', 'profiles.id', '=', 'users.profile_id')
            ->orderBy('profiles.first_name', 'asc')
            ->orderBy('profiles.last_name', 'asc');

        //  todo: filter, sort & pagination

        return IndexData::from($builder->get());
    }
}
