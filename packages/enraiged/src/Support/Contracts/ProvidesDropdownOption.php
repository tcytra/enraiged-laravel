<?php

namespace Enraiged\Support\Contracts;

interface ProvidesDropdownOption
{
    /**
     *  Format and return the dropdown option for this model.
     *
     *  @param  bool    $wrap = false
     *  @return array
     */
    public function dropdownOption(bool $wrap = false): array;
}
