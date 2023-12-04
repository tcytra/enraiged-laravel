<?php

namespace Enraiged\Support\Builders;

use Enraiged\Enums\FileTypes;
use Enraiged\Support\Builders\Enums\TemplateSources;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Symfony\Component\HttpKernel\Exception\PreconditionFailedHttpException;

class MenuBuilder
{
    use Security\AssertSecure,
        Security\RoleAssertions,
        Security\UserAssertions,
        Traits\LoadParameters;

    /** @var  array|bool  Perform a cleanup on the processed menu. */
    protected $clean = true;

    /** @var  array  The menu items collection. */
    protected $menu;

    /** @var  string  The menu items name. */
    protected $name;

    /** @var  Request  The http request. */
    protected $request;

    /** @var  string  The menu configuration source. */
    protected $source = 'file';

    /** @var  string  The menu template file location. */
    protected $template;

    /**
     *  Create an instance of the TableBuilder.
     *
     *  @param  \Illuminate\Http\Request  $request
     *  @param  array   $parameters = []
     *  @return void
     */
    public function __construct(Request $request, array $parameters = [])
    {
        $this->request = $request;

        if (count($parameters)) {
            $this->load($parameters);
        }
    }

    /**
     *  Perform final cleanup in the processed menu.
     *
     *  return self
     */
    protected function clean()
    {
        if ($this->clean) {
            $except = gettype($this->clean) === 'array'
                ? $this->clean
                : 'secure';

            $clean = collect($this->menu)
                ->transform(fn ($item) => collect($item)
                    ->except($except)
                    ->toArray());

            $this->menu = $clean->toArray();
        }

        return $this;
    }

    /**
     *  Retrieve the menu from the specified source.
     *
     *  @return self
     */
    protected function fetch()
    {
        $menu = null;

        if ($this->source === TemplateSources::Database) {
            
        }

        if ($this->source === TemplateSources::Filesystem) {
            if (!$this->template) {
                throw new PreconditionFailedHttpException(__('exceptions.template.undefined'));
            }
            if (!File::exists($this->template)) {
                throw new PreconditionFailedHttpException(__('exceptions.template.missing'));
            }

            if (File::mimeType($this->template) === FileTypes::JSON) {
                $menu = json_decode(file_get_contents($this->template), true);
            }
            if (File::mimeType($this->template) === FileTypes::PHP) {
                $menu = include $this->template;
            }
        }

        $this->menu = $this instanceof Contracts\ShouldPreprocess
            ? collect($menu)
                ->transform(fn ($item, $index) => $this
                    ->preprocess($this->request, $item, $index))
                ->toArray()
            : $menu;

        return $this;
    }

    /**
     *  Create and return the application menu against the provided request.
     *
     *  @return array
     */
    protected function handle(): array
    {
        (object) $this
            ->fetch()
            ->secure()
            ->clean();

        return $this->menu;
    }

    /**
     *  Secure the menu for the authenticated user.
     *
     *  @return self
     */
    protected function secure()
    {
        $menu = collect($this->menu)
            ->transform(function ($item) {
                if (key_exists('menu', $item)) {
                    $secure = $this->secure(collect($item['menu']));
                    
                    if ($secure->count()) {
                        $item['menu'] = $secure->toArray();
                        return $item;
                    }

                    return null;
                }

                return $item;
            })
            ->filter(function ($item) {
                if (!$item) {
                    return false;
                }

                return $this->assertSecure($item);
            })
            ->toArray();

        $this->menu = $this instanceof Contracts\ShouldPostprocess
            ? collect($menu)
                ->transform(fn ($item, $index) => $this
                    ->postprocess($this->request, $item, $index))
                ->toArray()
            : $menu;

        return $this;
    }

    /**
     *  Create and return a menu from the request.
     *
     *  @param  \Illuminate\Http\Request  $request
     *  @param  array   $parameters = []
     *  @return \Enraiged\Tables\Builders\TableBuilder
     *  @static
     */
    public static function From(Request $request, array $parameters = [])
    {
        $called = get_called_class();

        return (new $called($request, $parameters))
            ->handle();
    }
}
