<?php

namespace Module\MyFoundation\Http\Resources;

use Module\MyFoundation\Models\MyFoundationCommunity;
use Illuminate\Http\Resources\Json\ResourceCollection;

class CommunityCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return CommunityResource::collection($this->collection);
    }

    /**
     * Get additional data that should be returned with the resource array.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function with($request): array
    {
        if ($request->has('initialized')) {
            return [];
        }

        return [
            'setups' => [
                /** the page combo */
                'combos' => MyFoundationCommunity::mapCombos($request),

                /** the page data filter */
                'filters' => MyFoundationCommunity::mapFilters(),

                /** the table header */
                'headers' => MyFoundationCommunity::mapHeaders($request),

                /** the page icon */
                'icon' => MyFoundationCommunity::getPageIcon('myfoundation-community'),

                /** the record key */
                'key' => MyFoundationCommunity::getDataKey(),

                /** the page default */
                'recordBase' => MyFoundationCommunity::mapRecordBase($request),

                /** the page statuses */
                'statuses' => MyFoundationCommunity::mapStatuses($request),

                /** the page data mode */
                'trashed' => $request->trashed ?: false,

                /** the page title */
                'title' => MyFoundationCommunity::getPageTitle($request, 'myfoundation-community'),

                /** the usetrash flag */
                'usetrash' => MyFoundationCommunity::hasSoftDeleted(),
            ]
        ];
    }
}
