<?php

namespace Enraiged\Forms\Requests;

use Illuminate\Foundation\Http\FormRequest as Request;

class FormRequest extends Request
{
    /** @var  string  The status returned from the auth processing. */
    public $status;

    /** @var  bool|null  The boolean status of this request. */
    public $success;

    /**
     *  Determine if the user is authorized to make this request.
     *
     *  @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     *  Get the validation rules that apply to the request.
     *
     *  @return Illuminate\Support\Collection
     */
    public function collected(): Collection
    {
        return collect($this->validated());
    }

    /**
     *  Get the validation rules that apply to the request.
     *
     *  @return array
     */
    public function rules()
    {
        return $this->rules;
    }

    /**
     *  Set or get the request status.
     *
     *  @param  string|null  $value
     *  @return string|null
     */
    public function status($value = null)
    {
        if ($value) {
            $this->status = preg_match('/\w{1,}/', $value) ? $value : null;
        }

        return $this->status;
    }

    /**
     *  Set or get the boolean success status.
     *
     *  @param  bool|null  $success
     *  @return bool|null
     */
    public function success($success = null)
    {
        if ($success) {
            $this->success = $success == true;
        }

        return $this->success;
    }
}
