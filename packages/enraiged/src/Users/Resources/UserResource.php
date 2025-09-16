<?php

namespace Enraiged\Users\Resources;

use App\Http\Resources\JsonResource;
use Enraiged\Tables\Traits\ModelDeletedBackground;
use Enraiged\Tables\Traits\ModelInactiveBackground;

class UserResource extends JsonResource
{
    use Traits\Avatar,
        Traits\Profile,
        Traits\Role,
        ModelDeletedBackground,
        ModelInactiveBackground;

    /** @var  bool  Whether or not to include the tracking objects with this resource. */
    protected bool $with_tracking = true;

    /**
     *  Transform the resource collection into an array.
     *
     *  @param  \Illuminate\Http\Request  $request
     *  @return array
     */
    public function toArray($request): array
    {
        $resource = [
            'id' => $this->id,
            'email' => $this->email,
            'name' => $this->profile->name,
            'theme' => $this->theme ?? config('enraiged.theme.color'),
            'username' => $this->username,
            'is_active' => $this->is_active,
            'is_myself' => $this->is_myself,
            'language' => $this->language,
            'timezone' => $this->timezone,
        ];

        if ($this->with_avatar) {
            $resource['avatar'] = $this->avatar();
        }

        if ($this->with_profile) {
            $resource['profile'] = $this->profile();
        }

        if ($this->with_role && $this->hasRole()) {
            $resource['role'] = $this->role();
        }

        if ($this->with_severity) {
            $resource['__'] = $this->modelDeletedBackground() ?? $this->modelInactiveBackground();
        }

        if ($this->with_tracking) {
            $resource['created'] = $this->resource->created;
        }

        if (($this->with_deleted || $this->with_tracking) && !is_null($this->deleted_at)) {
            $resource['deleted'] = $this->resource->deleted;
        }

        if ($this->with_tracking && $this->created_at !== $this->updated_at) {
            $resource['updated'] = $this->resource->updated;
        }

        return $resource;
    }
}
