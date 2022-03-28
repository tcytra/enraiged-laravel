<?php

namespace App\Http\Resources\Notifications;

use App\Http\Resources\JsonResource;

class FlashMessageResource extends JsonResource
{
    /**
     *  Transform the resource collection into an array.
     *
     *  @param  \Illuminate\Http\Request  $request
     *  @return array
     */
    public function toArray($request): array
    {
        return [
            'data' => $request->session()->get('data'),
            'message' => $request->session()->get('message'),
            'status' => $request->session()->get('status'),
        ];
    }
}
