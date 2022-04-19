<?php

namespace Enraiged\Tables\Contracts;

interface ProvidesTableBuilder
{
    /**
     *  Create and return a TableBuilder from the current Request.
     *
     *  @return \Enraiged\Tables\Builders\IndexBuilder
     */
    public function table();
}
