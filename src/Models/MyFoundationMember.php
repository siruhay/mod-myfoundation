<?php

namespace Module\MyFoundation\Models;

use Illuminate\Http\Request;
use Module\System\Traits\HasMeta;
use Illuminate\Support\Facades\DB;
use Module\System\Models\SystemUser;
use Module\System\Traits\Filterable;
use Module\System\Traits\Searchable;
use Module\System\Traits\HasPageSetup;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Module\Posyandu\Models\PosyanduService;
use Illuminate\Database\Eloquent\SoftDeletes;
use Module\Foundation\Models\FoundationGender;
use Module\Foundation\Models\FoundationMember;
use Module\Foundation\Models\FoundationPosition;
use Module\Foundation\Models\FoundationCommunity;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Module\MyFoundation\Http\Resources\MemberResource;

class MyFoundationMember extends Model
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
    protected $table = 'foundation_biodatas';

    /**
     * The roles variable
     *
     * @var array
     */
    protected $roles = ['myfoundation-member'];

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
     * addGlobalScope function
     *
     * @return void
     */
    protected static function booted(): void
    {
        static::addGlobalScope('official', function (Builder $builder) {
            $builder->where('type', 'LKD');
        });
    }

    /**
     * mapCombos function
     *
     * @param Request $request
     * @return array
     */
    public static function mapCombos(Request $request): array
    {
        $community = FoundationCommunity::find($request->segment(4));

        return [
            'scopes' => PosyanduService::forCombo(),
            'genders' => FoundationGender::forCombo(),
            'positions' => $community->positions()->orderBy('_lft')->forCombo()
        ];
    }

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
            ['title' => 'Nama', 'value' => 'name'],
            ['title' => 'N.I.K', 'value' => 'slug'],
            ['title' => 'Jabatan', 'value' => 'position'],
            ['title' => 'S.P.M', 'value' => 'scope'],
            ['title' => 'Updated', 'value' => 'updated_at', 'sortable' => false, 'width' => '170'],
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
            'id' => $model->id,
            'name' => $model->name,
            'slug' => $model->slug,
            'position' => $model->position->name,
            'scope' => optional($model->service)->name,

            'subtitle' => (string) $model->updated_at,
            'updated_at' => (string) $model->updated_at,
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
            'name' => $model->name,
            'slug' => $model->slug,
            'phone' => $model->phone,
            'gender_id' => $model->gender_id,
            'position_id' => $model->position_id,
            'village_id' => $model->village_id,
            'subdistrict_id' => $model->subdistrict_id,
            'regency_id' => $model->regency_id,
            'communitymap_id' => $model->communitymap_id,
            'citizen' => $model->citizen,
            'neighborhood' => $model->neighborhood,
            'scope' => $model->scope,
        ];
    }

    /**
     * user function
     *
     * @return MorphOne
     */
    public function user(): MorphOne
    {
        return $this->morphOne(SystemUser::class, 'userable');
    }

    /**
     * position function
     *
     * @return BelongsTo
     */
    public function position(): BelongsTo
    {
        return $this->belongsTo(FoundationPosition::class, 'position_id');
    }

    /**
     * service function
     *
     * @return BelongsTo
     */
    public function service(): BelongsTo
    {
        return $this->belongsTo(PosyanduService::class, 'scope');
    }

    /**
     * The model store method
     *
     * @param Request $request
     * @return void
     */
    public static function storeRecord(Request $request, $parent)
    {
        return FoundationMember::storeRecord($request, $parent);
    }

    /**
     * The model update method
     *
     * @param Request $request
     * @param [type] $model
     * @return void
     */
    public static function updateRecord(Request $request, $model, $parent)
    {
        return FoundationMember::updateRecord($request, $model, $parent);
    }

    /**
     * The model delete method
     *
     * @param [type] $model
     * @return void
     */
    public static function deleteRecord($model)
    {
        DB::connection($model->connection)->beginTransaction();

        try {
            $model->forceDelete();

            DB::connection($model->connection)->commit();

            return new MemberResource($model);
        } catch (\Exception $e) {
            DB::connection($model->connection)->rollBack();

            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
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
