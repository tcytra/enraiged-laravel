<?php

namespace Enraiged\Users\Models\Traits;

trait DropdownOption
{
    /**
     *  Return the dropdown option for this model.
     *
     *  @param  bool    $wrap = false
     *  @return array
     */
    public function dropdownOption(bool $wrap = false): array
    {
        $option = [
            'id' => $this->id,
            'name' => $this->profile->name,
        ];

        return $wrap
            ? [$option]
            : $option;
    }
}
