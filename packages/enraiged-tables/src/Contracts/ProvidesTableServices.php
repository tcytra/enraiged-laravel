<?php

namespace Enraiged\Tables\Contracts;

interface ProvidesTableServices
{
    /**
     *  Return the data for the table request.
     *
     *  @return array
     */
    public function data(): array;

    /**
     *  Return the assembled table template.
     *
     *  @return array
     */
    public function template(): array;
}
