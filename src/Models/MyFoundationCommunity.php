<?php

namespace Module\MyFoundation\Models;

use Illuminate\Http\Request;
use Module\System\Traits\HasMeta;
use Module\System\Traits\Filterable;
use Module\System\Traits\Searchable;
use Module\System\Traits\HasPageSetup;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Module\Foundation\Models\FoundationVillage;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Module\Foundation\Models\FoundationSubdistrict;
use Module\Foundation\Models\FoundationCommunitymap;

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
     * mapCombos function
     *
     * @param Request $request
     * @return array
     */
    public static function mapCombos(Request $request, $model = null): array
    {
        return [
            'communitymaps' => FoundationCommunitymap::forCombo(),
            'subdistricts' => FoundationSubdistrict::where('regency_id', 3)->forCombo(),
            'villages' => optional($model)->subdistrict_id ? FoundationVillage::where('district_id', $model->subdistrict_id)->forCombo() : [],
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
            'id'                => $model->id,
            'name'              => $model->name,
            'communitymap_id'   => $model->communitymap_id,
            'subdistrict_id'    => $model->subdistrict_id,
            'village_id'        => $model->village_id,
        ];
    }

    /**
     * Undocumented function
     *
     * @param Builder $query
     * @param [type] $user
     * @return void
     */
    public function scopeForCurrentUser(Builder $query, $user)
    {
        return $query
            ->where('id', $user->userable->community_id);
    }

    /**
     * Undocumented function
     *
     * @return HasMany
     */
    public function members(): HasMany
    {
        return $this->hasMany(MyFoundationMember::class, 'community_id');
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
}
