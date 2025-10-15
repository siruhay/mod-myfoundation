<?php

namespace Module\MyFoundation\Models;

use Illuminate\Http\Request;
use Module\System\Traits\HasMeta;
use Module\System\Traits\Filterable;
use Module\System\Traits\Searchable;
use Module\System\Traits\HasPageSetup;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Module\Foundation\Models\FoundationVillage;
use Module\Foundation\Models\FoundationSubdistrict;
use Module\Foundation\Models\FoundationCommunitymap;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Module\Reference\Models\ReferenceSubdistrict;
use Module\Reference\Models\ReferenceVillage;

class MyFoundationCommunity extends Model
{
    use Filterable;
    use HasMeta;
    use HasPageSetup;
    use Searchable;
    use SoftDeletes;

    /**
     * The connection name for the model.
     *
     * @var string|null
     */
    protected $connection = 'platform';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'foundation_communities';

    /**
     * The roles variable
     *
     * @var array
     */
    protected $roles = ['myfoundation-community'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'meta' => 'array'
    ];

    /**
     * The default key for the order.
     *
     * @var string
     */
    protected $defaultOrder = 'name';

    /**
     * mapHeaders function
     *
     * readonly value?: SelectItemKey<any>
     * readonly title?: string | undefined
     * readonly align?: 'start' | 'end' | 'center' | undefined
     * readonly width?: string | number | undefined
     * readonly minWidth?: string | undefined
     * readonly maxWidth?: string | undefined
     * readonly nowrap?: boolean | undefined
     * readonly sortable?: boolean | undefined
     *
     * @param Request $request
     * @return array
     */
    public static function mapHeaders(Request $request): array
    {
        return [
            ['title' => 'Name', 'value' => 'name'],
            ['title' => 'Jenis', 'value' => 'communitymap_name'],
            ['title' => 'Kecamatan', 'value' => 'subdistrict_name'],
            ['title' => 'Desa/Keluran', 'value' => 'village_name'],
            ['title' => 'Updated', 'value' => 'updated_at', 'sortable' => false, 'width' => '170'],
        ];
    }

    /**
     * mapCombos function
     *
     * @param Request $request
     * @return array
     */
    public static function mapCombos(Request $request, $model = null): array
    {
        return [
            'communitymaps' => FoundationCommunitymap::forCombo(),
            'subdistricts'  => FoundationSubdistrict::where('regency_id', 3)->forCombo(),
            'villages'      => optional($model)->subdistrict_id ? FoundationVillage::where('district_id', $model->subdistrict_id)->forCombo() : [],
        ];
    }

    /**
     * mapStatuses function
     *
     * @param Request $request
     * @return array
     */
    public static function mapStatuses(Request $request): array
    {
        return [
            'canCreate'     => false,
            'canEdit'       => true,
            'canUpdate'     => true,
            'canDelete'     => false,
            'canRestore'    => false,
            'canDestroy'    => false,
        ];
    }

    /**
     * mapResource function
     *
     * @param Request $request
     * @return array
     */
    public static function mapResource(Request $request, $model): array
    {
        return [
            'id'                => $model->id,
            'name'              => $model->name,
            'communitymap_name' => optional($model->communitymap)->name,
            'subdistrict_name'  => optional($model->subdistrict)->name,
            'village_name'      => optional($model->village)->name,
            'subtitle'          => (string) $model->updated_at,
            'updated_at'        => (string) $model->updated_at,
        ];
    }

    /**
     * mapResourceShow function
     *
     * @param Request $request
     * @return array
     */
    public static function mapResourceShow(Request $request, $model): array
    {
        return [
            'id'                    => $model->id,
            'name'                  => $model->name,
            'communitymap_id'       => $model->communitymap_id,
            'communitymap_name'     => optional($model->communitymap)->id,
            'subdistrict_id'        => $model->subdistrict_id,
            'village_id'            => $model->village_id,
            'file'                  => $model->file
        ];
    }

    /**
     * scopeForCurrentUser function
     *
     * @param Builder $query
     * @param [type] $user
     * @return void
     */
    public function scopeForCurrentUser(Builder $query, $user)
    {
        return $query
            ->where('id', $user->userable->workunitable_id);
    }

    /**
     * communitymap function
     *
     * @return BelongsTo
     */
    public function communitymap(): BelongsTo
    {
        return $this->belongsTo(FoundationCommunitymap::class, 'communitymap_id');
    }

    /**
     * members function
     *
     * @return MorphMany
     */
    public function members(): MorphMany
    {
        return $this->morphMany(MyFoundationMember::class, 'workunitable');
    }

    /**
     * subdistrict function
     *
     * @return BelongsTo
     */
    public function subdistrict(): BelongsTo
    {
        return $this->belongsTo(ReferenceSubdistrict::class, 'subdistrict_id');
    }

    /**
     * village function
     *
     * @return BelongsTo
     */
    public function village(): BelongsTo
    {
        return $this->belongsTo(ReferenceVillage::class, 'village_id');
    }

    /**
     * The model store method
     *
     * @param Request $request
     * @return void
     */
    public static function storeRecord(Request $request)
    {
        //
    }

    /**
     * The model update method
     *
     * @param Request $request
     * @param [type] $model
     * @return void
     */
    public static function updateRecord(Request $request, $model)
    {
        //
    }

    /**
     * The model delete method
     *
     * @param [type] $model
     * @return void
     */
    public static function deleteRecord($model)
    {
        //
    }

    /**
     * The model restore method
     *
     * @param [type] $model
     * @return void
     */
    public static function restoreRecord($model)
    {
        //
    }

    /**
     * The model destroy method
     *
     * @param [type] $model
     * @return void
     */
    public static function destroyRecord($model)
    {
        //
    }

    /**
     * The model upload method
     *
     * @param Request $request
     * @param [type] $model
     * @return void
     */
    public static function uploadRecord(Request $request, $model)
    {
        //
    }
}
