<?php

namespace Module\MyFoundation\Http\Resources;

use Module\MyFoundation\Models\MyFoundationOfficial;
use Illuminate\Http\Resources\Json\ResourceCollection;

class OfficialCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return OfficialResource::collection($this->collection);
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
                'combos' => MyFoundationOfficial::mapCombos($request),

                /** the page data filter */
                'filters' => MyFoundationOfficial::mapFilters(),

                /** the table header */
                'headers' => MyFoundationOfficial::mapHeaders($request),

                /** the page icon */
                'icon' => MyFoundationOfficial::getPageIcon('myfoundation-official'),

                /** the record key */
                'key' => MyFoundationOfficial::getDataKey(),

                /** the page default */
                'recordBase' => MyFoundationOfficial::mapRecordBase($request),

                /** the page statuses */
                'statuses' => MyFoundationOfficial::mapStatuses($request),

                /** the page data mode */
                'trashed' => $request->trashed ?: false,

                /** the page title */
                'title' => MyFoundationOfficial::getPageTitle($request, 'myfoundation-official'),

                /** the usetrash flag */
                'usetrash' => MyFoundationOfficial::hasSoftDeleted(),
            ]
        ];
    }
}
