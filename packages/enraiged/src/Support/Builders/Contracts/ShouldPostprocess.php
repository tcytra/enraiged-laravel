<?php

namespace Enraiged\Support\Builders\Contracts;

use Enraiged\Support\Collections\RequestCollection;

interface ShouldPostprocess
{
    /**
     *  Perform a postprocess routine on an indexed item.
     *
     *  @param  \Enraiged\Support\Collections\RequestCollection  $request
     *  @param  mixed   $item
     *  @param  string  $index
     *  @return array
     */
    public function postprocess(RequestCollection $request, $item, $index): array;
}
