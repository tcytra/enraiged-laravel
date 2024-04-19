<?php

namespace Enraiged\Files\Traits;

use Enraiged\Files\Models\File as Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Http\File;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

trait Attachable
{
    /**
     *  @return void
     */
    protected static function bootAttachable()
    {
        self::deleting(function ($model) {
            if ($model->file->exists) {
                $model->file->delete();
            }
        });
    }

    /**
     *  @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function file(): MorphOne
    {
        return $this->morphOne(Model::class, 'attachable')->withDefault();
    }

    /**
     *  Attach a file from a local seed.
     *
     *  @param  \Illuminate\Http\File $file
     *  @return self
     */
    public function seed(File $file)
    {
        if ($this->file->path) {
            Storage::delete($this->file->path);
        }

        $file_name = $file->getBasename();
        $storage_name = sha1(Str::random(20)).'.'.$file->getExtension();
        $storage_path = "{$this->folder}/{$storage_name}";

        $file->move(storage_path("app/{$this->folder}"), $storage_name);

        $this->file->attach($file_name, $storage_path);

        return $this;
    }

    /**
     *  Store the uploaded file.
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
