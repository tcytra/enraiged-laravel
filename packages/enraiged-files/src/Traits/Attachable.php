<?php

namespace Enraiged\Files\Traits;

use Enraiged\Files\Models\File as Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Http\File;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Spatie\LaravelImageOptimizer\Facades\ImageOptimizer;

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
     *  @return string
     */
    public function folder(): string
    {
        return $this->folder ?: 'files';
    }

    /**
     *  Optimize an image file, if possible.
     *
     *  @return self
     */
    public function optimize()
    {
        if (preg_match('/^image/', $this->file->mime)) {
            ImageOptimizer::optimize($this->path());
        }

        return $this;
    }

    /**
     *  Return the full filesystem path to the stored file.
     *
     *  @return string
     */
    public function path(): string
    {
        return storage_path("app/{$this->file->path}");
    }

    /**
     *  Resize an image file to the provided dimensions, if possible.
     *
     *  @return self
     */
    public function resize(): self
    {
        if (preg_match('/^image/', $this->file->mime) && $this->resize) {
            $resize = (object) $this->resize;

            if (property_exists($resize, 'width') || property_exists($resize, 'height')) {
                $path = $this->path();

                $image = ImageManager::imagick()->read($path);
                $height = $image->height();
                $width = $image->width();

                if ($height > $width) {
                    $image->scaleDown(width: $resize->width);
                } else {
                    $image->scaleDown(height: $resize->height);
                }

                if (property_exists($resize, 'strict') && $resize->strict === true) {
                    $image->cover($resize->width, $resize->height);
                }

                $image->save($path);
            }
        }

        return $this;
    }

    /**
     *  Attach a file from a local seed.
     *
     *  @param  \Illuminate\Http\File $file
     *  @return self
     */
    public function seed(File $file): self
    {
        if ($this->file->path) {
            Storage::delete($this->file->path);
        }

        $file_name = $file->getBasename();
        $storage_name = sha1(Str::random(20)).'.'.$file->getExtension();
        $storage_path = "{$this->folder}/{$storage_name}";

        copy($file->getPathName(), storage_path("app/{$storage_path}"));

        $this->file->attach($file_name, $storage_path);

        return $this
            ->optimize()
            ->resize();
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

        return $this
            ->optimize()
            ->resize();
    }
}
