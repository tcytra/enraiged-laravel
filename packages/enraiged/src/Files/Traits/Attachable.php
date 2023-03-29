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
        Storage::delete($this->file->path);

        $storage_path = $this->folder;
        $storage_file = "{$storage_path}/".Str::random(40).'.'.$file->getExtension();

        copy($file->getPathName(), storage_path("app/{$storage_file}"));

        $original_name = strtolower((new \ReflectionClass($this->{$this->morphable}))->getShortName())
            ."-{$this->table}-".$this->{$this->morphable}->id
            .'.'.$file->getExtension();

        $this->file->attach($storage_file, $original_name);

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
