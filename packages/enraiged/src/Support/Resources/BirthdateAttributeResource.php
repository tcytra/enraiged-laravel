<?php

namespace Enraiged\Support\Resources;

use App\Http\Resources\JsonResource;

class BirthdateAttributeResource extends JsonResource
{
    /** @var  string  An optional, specific attribute to evaluate. */
    protected $attribute = 'birthdate';

    /** @var  User  The request user. */
    protected $user;

    /**
     *  Transform the resource collection into an array.
     *
     *  @param  \Illuminate\Http\Request  $request
     *  @return array
     */
    public function toArray($request): array
    {
        $this->user = $request->user();

        $attribute = $this->attribute;
        $format = $this->format($this->user->dateformat ?? 'Y-m-d');
        $birthdate = date($format, strtotime($this->{$attribute}));

        return [$attribute => $birthdate];
    }

    /**
     *  @param  string  $format
     *  @return string
     */
    private function format($format)
    {
        return $this->user->hide_birthyear
            ? trim(str_replace('Y', '', $format), ' -_/,')
            : $format;
    }
}
