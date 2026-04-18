<?php

namespace App\Packages\Users\Models\Traits;

use App\Packages\Users\Forms\UserForm;
use Enraiged\Forms\Builders\FormBuilder;
use Illuminate\Http\Request;

trait ProvidesForms
{
    /**
     *  Create and return a form builder instance against this model.
     *
     *  @param  \Illuminate\Http\Request  $request
     *  @return \Enraiged\Forms\Builders\FormBuilder
     */
    #[\Override]
    public function form(Request $request): FormBuilder
    {
        $form = (new UserForm($request, $this))
            ->disabledIf(['role_id', 'is_active', 'is_hidden', 'is_protected'], $this->isProtected);

        return $this->exists
            ? $form->edit('users.update', ['user' => $this->id])
            : $form->create('users.store');
    }
}
