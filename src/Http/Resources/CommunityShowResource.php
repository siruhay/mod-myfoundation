<?php

namespace Module\MyFoundation\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Module\MyFoundation\Models\MyFoundationCommunity;
use Module\System\Http\Resources\UserLogActivity;

class CommunityShowResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            /**
             * the record data
             */
            'record' => MyFoundationCommunity::mapResourceShow($request, $this),

            /**
             * the page setups
             */
            'setups' => [
                'combos' => MyFoundationCommunity::mapCombos($request, $this),

                'icon' => MyFoundationCommunity::getPageIcon('myfoundation-community'),

                'key' => MyFoundationCommunity::getDataKey(),

                'logs' => $request->activities ? UserLogActivity::collection($this->activitylogs) : null,

                'softdelete' => $this->trashed() ?: false,

                'statuses' => MyFoundationCommunity::mapStatuses($request, $this),

                'title' => MyFoundationCommunity::getPageTitle($request, 'myfoundation-community'),
            ],
        ];
    }
}
