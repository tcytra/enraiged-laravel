<?php

namespace Enraiged\Enums\Services;

use Illuminate\Support\Collection;
use ReflectionClass;

/**
 *  This is a 'minimized' version of LaravelEnso Enum and will be replaced in a near future version of Enraiged.
 *
 *  @see https://github.com/laravel-enso/enums
 */
class Enum
{
    protected static array $data;
    protected static bool $localisation = true;

    private static function attributes(): Collection
    {
        return self::transAll(self::source());
    }

    public static function constants(): array
    {
        $reflection = new ReflectionClass(static::class);

        $filter = fn ($constant) => is_string($constant) || is_numeric($constant);

        $valid = array_filter($reflection->getConstants(), $filter);

        $constants = array_flip($valid);

        $filter = fn ($constant) => $reflection
            ->getReflectionConstant($constant)->isPublic();

        $public = array_filter($constants, $filter);

        return $public;
    }

    protected static function data(): array
    {
        return [];
    }

    public static function get($key)
    {
        return self::attributes()->get($key);
    }

    public static function keys(): Collection
    {
        return self::attributes()->keys();
    }

    public static function localisation(bool $state = true): void
    {
        static::$localisation = $state;
    }

    public static function select(): Collection
    {
        return self::attributes()
            ->map(fn ($value, $key) => (object) ['id' => $key, 'name' => $value])
            ->values();
    }

    private static function source(): array
    {
        if (!empty(static::data())) {
            return static::data();
        }

        if (isset(static::$data)) {
            return static::$data;
        }

        return static::constants();
    }

    private static function transAll($data): Collection
    {
        return Collection::wrap($data)->map(fn ($value) => self::trans($value));
    }

    private static function trans($value)
    {
        return is_string($value) && static::$localisation
            ? __($value)
            : $value;
    }

    public static function values(): Collection
    {
        return self::attributes()->values();
    }
}
