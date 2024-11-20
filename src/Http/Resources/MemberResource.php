<?php

namespace Module\MyFoundation\Http\Resources;

use Module\MyFoundation\Models\MyFoundationMember;
use Illuminate\Http\Resources\Json\JsonResource;

class MemberResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return MyFoundationMember::mapResource($request, $this);
    }
}
