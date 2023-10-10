<?php

namespace Enraiged\Agreements\Models;

use Enraiged\Agreements\Enums\AgreementStatus;
use Enraiged\Support\Database\Traits\UserTracking;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Agreement extends Model
{
    use Attributes\Published,
        Relations\BelongsToManyUsers,
        SoftDeletes, UserTracking;

    /** @var  array  The attributes that are mass assignable. */
    protected $fillable = ['content', 'type', 'version'];

    /** @var  array  The attributes that should be cast. */
    protected $casts = [
        'created_at' => 'datetime',
        'deleted_at' => 'datetime',
        'published_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    //  Global methods

    /**
     *  Return the collection of current agreements.
     *
     *  @param  string  $type = null
     *  @return Agreement|Illuminate\Database\Eloquent\Collection
     *  @static
     */
    public static function current($type = null)
    {
        $current = self::where('status', AgreementStatus::Published);

        return $type
            ? $current->where('type', $type)->first()
            : $current->orderBy('published_at', 'desc')->get();
    }

    /**
     *  Return the collection of required agreements.
     *
     *  @return Illuminate\Database\Eloquent\Collection
     *  @static
     */
    public static function required()
    {
        $config = json_decode(json_encode( config('enraiged.auth.must_agree_to_terms') ));

        if (gettype($config) === 'object' && property_exists($config, 'required_terms')) {
            $terms = self::where('status', AgreementStatus::Published)
                ->whereIn('type', collect($config->required_terms)->toArray())
                ->orderBy('published_at', 'desc')
                ->groupBy('type')
                ->groupBy('id')
                ->pluck('id')
                ->toArray();

            return self::whereIn('id', $terms)->get();
        }

        return $config === true
            ? self::current()
            : self::whereRaw('true = false')->get();
    }
}
