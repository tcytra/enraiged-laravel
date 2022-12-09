<?php

namespace Enraiged\Avatars\Models;

use Enraiged\Files\Traits\HasFile;
use Enraiged\Support\Traits\CreatedBy;
use Enraiged\Support\Traits\UpdatedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\File;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Avatar extends Model
{
    use Attributes\Folder,
        CreatedBy, HasFile, UpdatedBy;

    /** @var  string  The database table name. */
    protected $table = 'avatars';

    /** @var  array  The attributes that aren't mass assignable. */
    protected $guarded = ['id'];

    /** @var  array  The attributes that should be cast. */
    protected $casts = [
        'avatarable_id' => 'int',
    ];

    /**
     *  Get the parent avatarable model.
     *
     *  @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function avatarable()
    {
        return $this->morphTo();
    }

    /**
     *  Attach an avatar from a local file.
     *
     *  @param  \Illuminate\Http\File $file
     *  @return self
     */
    public function seed(File $file)
    {
        Storage::delete($this->file->path);

        $seeded_file = 'avatars/'.Str::random(40).'.'.$file->getExtension();

        copy($file->getPathName(), storage_path("app/{$seeded_file}"));

        $original_name = strtolower((new \ReflectionClass($this->avatarable))->getShortName())
            .'-avatar'.$this->avatarable->id
            .'.'.$file->getExtension();

        $this->file->attach($seeded_file, $original_name);

        return $this;
    }

    /**
     *  Store the uploaded avatar.
     *
     *  @param  \Illuminate\Http\UploadedFile  $file
     *  @return \Enraiged\Avatars\Models\Avatar  $avatar
     */
    public function upload(UploadedFile $file)
    {
        DB::transaction(function () use ($file) {
            $this->file->delete();
            $this->file->upload($file);
        });

        return $this;
    }
}
