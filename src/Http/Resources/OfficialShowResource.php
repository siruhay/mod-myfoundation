<?php

namespace Module\MyFoundation\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Module\MyFoundation\Models\MyFoundationOfficial;
use Module\System\Http\Resources\UserLogActivity;

class OfficialShowResource extends JsonResource
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
            'record' => MyFoundationOfficial::mapResourceShow($request, $this),

            /**
             * the page setups
             */
            'setups' => [
                'combos' => MyFoundationOfficial::mapCombos($request, $this),

                'icon' => MyFoundationOfficial::getPageIcon('myfoundation-official'),

                'key' => MyFoundationOfficial::getDataKey(),

                'logs' => $request->activities ? UserLogActivity::collection($this->activitylogs) : null,

                'softdelete' => $this->trashed() ?: false,

                'statuses' => MyFoundationOfficial::mapStatuses($request, $this),

                'title' => MyFoundationOfficial::getPageTitle($request, 'myfoundation-official'),
            ],
        ];
    }
}
