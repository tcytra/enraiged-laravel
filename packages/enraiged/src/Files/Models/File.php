<?php

namespace Enraiged\Files\Models;

use Enraiged\Support\Traits\CreatedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\File as IlluminateFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
//use Symfony\Component\HttpFoundation\File\File as SymfonyFile;
use Symfony\Component\HttpFoundation\StreamedResponse;

class File extends Model
{
    use Attributes\Type,
        CreatedBy;

    /** @var  string  The database table name. */
    protected $table = 'files';

    /** @var  array  The attributes that aren't mass assignable. */
    protected $guarded = ['id'];

    /**
     *  @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function attachable()
    {
        return $this->morphTo();
    }

    /**
     *  Attach this file.
     *
     *  @param  string  $name
     *  @param  string  $path
     *  @return self
     */
    public function attach(string $name, string $path): self
    {
        $file = new IlluminateFile(Storage::path($path));

        $this->fill([
            'mime' => $file->getMimeType(),
            'name' => $name,
            'path' => $path,
            'size' => $file->getSize(),
        ])->save();

        return $this;
    }

    /**
     *  Delete the resource from the filesystem and database.
     *
     *  @return bool|null
     *  @throws \LogicException
     */
    public function delete()
    {
        Storage::delete($this->path);

        return parent::delete();
    }

    /**
     *  Download the resource file.
     *
     *  @return \Symfony\Component\HttpFoundation\StreamedResponse
     */
    public function download(): StreamedResponse
    {
        $name = Str::ascii($this->name);

        return Storage::download($this->path, $name);
    }

    /**
     *  Return the resource file.
     *
     *  @return \Symfony\Component\HttpFoundation\StreamedResponse
     */
    public function inline(): StreamedResponse
    {
        return Storage::response($this->path);
    }
}
