<?php

namespace Module\MyFoundation\Http\Resources;

use Module\MyFoundation\Models\MyFoundationCommunity;
use Illuminate\Http\Resources\Json\JsonResource;

class CommunityResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return MyFoundationCommunity::mapResource($request, $this);
    }
}
