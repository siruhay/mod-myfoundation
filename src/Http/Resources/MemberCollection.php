<?php

namespace Module\MyFoundation\Http\Resources;

use Module\MyFoundation\Models\MyFoundationMember;
use Illuminate\Http\Resources\Json\ResourceCollection;

class MemberCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return MemberResource::collection($this->collection);
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
                'combos' => MyFoundationMember::mapCombos($request),

                /** the page data filter */
                'filters' => MyFoundationMember::mapFilters(),

                /** the table header */
                'headers' => MyFoundationMember::mapHeaders($request),

                /** the page icon */
                'icon' => MyFoundationMember::getPageIcon('myfoundation-member'),

                /** the record key */
                'key' => MyFoundationMember::getDataKey(),

                /** the page default */
                'recordBase' => MyFoundationMember::mapRecordBase($request),

                /** the page statuses */
                'statuses' => MyFoundationMember::mapStatuses($request),

                /** the page data mode */
                'trashed' => $request->trashed ?: false,

                /** the page title */
                'title' => MyFoundationMember::getPageTitle($request, 'myfoundation-member'),

                /** the usetrash flag */
                'usetrash' => MyFoundationMember::hasSoftDeleted(),
            ]
        ];
    }
}
