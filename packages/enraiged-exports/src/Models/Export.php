<?php

namespace Enraiged\Exports\Models;

use Enraiged\Files\Models\File;
use Enraiged\Support\Database\Traits\Created;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Export extends Model
{
    use Created;

    /** @var  string  The database table name. */
    protected $table = 'exports';

    /** @var  array  The attributes that aren't mass assignable. */
    protected $guarded = ['id', 'status'];

    /**
     *  Register the Export events.
     *
     *  @return void
     *  @static
     */
    protected static function boot()
    {
        parent::boot();

        self::creating(function ($export) {
            if (!$export->rows) {
                $export->rows = 0;
            }

            if (!$export->status) {
                $export->status = -1;
            }

            return $export;
        });

        self::deleting(function ($export) {
            if ($export->file->exists) {
                $export->file->delete();
            }

            return $export;
        });
    }

    /**
     *  @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function file(): MorphOne
    {
        return $this->morphOne(File::class, 'attachable')->withDefault();
    }

    /**
     *  Return the export storage directory name.
     *
     *  @return string
     */
    public function folder(): string
    {
        return config('enraiged.tables.storage') ?? 'exports';
    }
}
