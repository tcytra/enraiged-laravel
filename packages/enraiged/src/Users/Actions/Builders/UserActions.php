<?php

namespace Enraiged\Users\Actions\Builders;

use Enraiged\Support\Builders\ActionBuilder;
use Enraiged\Support\Builders\Contracts\ShouldPostprocess;
use Enraiged\Support\Builders\Contracts\ShouldPreprocess;
use Enraiged\Support\Collections\RequestCollection;
use Enraiged\Users\Traits\Assertions\AssertIsDeleted;
use Enraiged\Users\Traits\Assertions\AssertIsNotDeleted;

class UserActions extends ActionBuilder implements ShouldPostprocess, ShouldPreprocess
{
    use AssertIsDeleted, AssertIsNotDeleted;

    /** @var  array|string  The configuration will include only this/these item(s). */
    //protected $only = ['show', 'edit'];

    /** @var  string  The menu configuration source type. */
    protected $source = 'file';

    /** @var  string  The actions template file location. */
    protected $template = __DIR__.'/../Templates/user-actions.json';

    /**
     *  Perform a preprocess routine on an indexed item.
     *
     *  @param  \Enraiged\Support\Collections\RequestCollection  $request
     *  @param  mixed   $item
     *  @param  string  $index
     *  @return array
     */
    public function postprocess(RequestCollection $request, $item, $index): array
    {
        switch ($index) {
            case 'show':
                $item['default'] = true;
                break;
            case 'delete':
            case 'restore':
                $item['uri'] = [...$item['uri'], 'redirect' => 'default'];
                break;
        }

        return $item;
    }

    /**
     *  Perform a preprocess routine on an indexed item.
     *
     *  @param  \Enraiged\Support\Collections\RequestCollection  $request
     *  @param  mixed   $item
     *  @param  string  $index
     *  @return array
     */
    public function preprocess(RequestCollection $request, $item, $index): array
    {
        $class = key_exists('class', $item)
            ? $item['class']
            : null;

        $severity = key_exists('severity', $item) && in_array($index, ['delete', 'restore'])
            ? 'p-button-'.$item['severity']
            : 'p-button-info';

        $item['class'] = trim("{$class} {$severity} p-button-text");

        return $item;
    }
}
