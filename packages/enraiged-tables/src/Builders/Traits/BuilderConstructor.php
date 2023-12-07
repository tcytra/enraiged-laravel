<?php

namespace Enraiged\Tables\Builders\Traits;

use Enraiged\Enums\FileTypes;
use Enraiged\Support\Builders\Enums\TemplateSources;
use Enraiged\Support\Builders\Traits\ParameterLoader;
use Enraiged\Tables\Support\TableRequestCollection;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Symfony\Component\HttpKernel\Exception\PreconditionFailedHttpException;

trait BuilderConstructor
{
    use ParameterLoader;

    /** @var  string  The css class(es) to apply to the table. */
    protected string $class;

    /** @var  string  The message to display when there are no records. */
    protected string $empty;

    /** @var  string  The table html id. */
    protected string $id;

    /** @var  string  The primary key column name. */
    protected string $key;

    /** @var  string  The route prefix. */
    protected string $prefix;

    /** @var  string  The table configuration source. */
    protected $source = 'file';

    /** @var  bool  The ability to preserve table state. */
    protected bool $state;

    /** @var  string  The table name. */
    protected string $table;

    /** @var  string  The request user. */
    protected User $user;

    /**
     *  Create an instance of the TableBuilder.
     *
     *  @param  \Illuminate\Http\Request  $request
     *  @param  array   $parameters = []
     *  @return void
     *
     *  @throws \Symfony\Component\HttpKernel\Exception\PreconditionFailedHttpException
     */
    public function __construct(Request $request, array $parameters = [])
    {
        $this->request = TableRequestCollection::from($request);
        $this->user = $request->user();

        $this->load(config('enraiged.tables.template'));

        if (count($parameters)) {
            $this->load($parameters);
        }

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
                $this->load(json_decode(file_get_contents($this->template), true));
            }
            if (File::mimeType($this->template) === FileTypes::PHP) {
                $menu = include $this->template;
                $this->load($menu);
            }
        }

        if ($this->request->has('export')) {
            $this->exportable();
        }
    }

    /**
     *  Return the specified attribute, if possible.
     *
     *  @param  string  $attribute
     *  @return mixed
     */
    public function get(string $attribute)
    {
        return property_exists($this, $attribute)
            ? $this->{$attribute}
            : null;
    }

    /**
     *  Create and return a Resource from a provided model.
     *
     *  @param  \Illuminate\Database\Eloquent\Model|null  $model
     *  @return \Illuminate\Http\Resources\Json\JsonResource|bool
     */
    public function resource($model = null)
    {
        if (is_null($model)) {
            return !is_null($this->resource);
        }

        return $this->resource::from($model);
    }

    /**
     *  @return string
     */
    protected function route($name, $params = []): string
    {
        return route($name, $params, config('enraiged.tables.absolute_uris'));
    }

    /**
     *  Return the table route prefix.
     *
     *  @param  array|string  $content
     *  @return self
     */
    public function setPrefix($content): self
    {
        if (gettype($content) === 'array') {
            foreach ($content as $each) {
                $method = $each['method'];

                if (method_exists($this, $method) && $this->{$method}($each)) {
                    $this->prefix = $each['prefix'];
                }
            }

        } else {
            $this->prefix = $content;
        }

        return $this;
    }

    /**
     *  Return the table user.
     *
     *  @return \Enraiged\Users\Models\User
     */
    public function user(): User
    {
        return $this->user;
    }

    /**
     *  Create and return a builder from the request and optional parameters.
     *
     *  @param  \Illuminate\Http\Request  $request
     *  @param  array  $parameters = []
     *  @return \Enraiged\Tables\Builders\TableBuilder
     *  @static
     */
    public static function From(Request $request, $parameters = [])
    {
        $called = get_called_class();

        return new $called($request, $parameters);
    }
}
