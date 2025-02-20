<?php

namespace Enraiged\Support\Builders\Contracts;

use Enraiged\Support\Collections\RequestCollection;

interface ShouldPreprocess
{
    /**
     *  Perform a preprocess routine on an indexed configuration item.
     *
     *  @param  \Enraiged\Support\Collections\RequestCollection  $request
     *  @param  mixed   $item
     *  @param  string  $index
     *  @return array
     */
    public function preprocess(RequestCollection $request, $item, $index): array;
}
