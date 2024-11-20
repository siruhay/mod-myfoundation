<?php

namespace Module\MyFoundation\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Module\MyFoundation\Models\MyFoundationOfficial;
use Module\MyFoundation\Http\Resources\OfficialCollection;
use Module\MyFoundation\Http\Resources\OfficialShowResource;

class MyFoundationOfficialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        Gate::authorize('view', MyFoundationOfficial::class);

        return new OfficialCollection(
            MyFoundationOfficial::applyMode($request->mode)
                ->filter($request->filters)
                ->search($request->findBy)
                ->sortBy($request->sortBy)
                ->paginate($request->itemsPerPage)
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Gate::authorize('create', MyFoundationOfficial::class);

        $request->validate([]);

        return MyFoundationOfficial::storeRecord($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Module\MyFoundation\Models\MyFoundationOfficial $myFoundationOfficial
     * @return \Illuminate\Http\Response
     */
    public function show(MyFoundationOfficial $myFoundationOfficial)
    {
        Gate::authorize('show', $myFoundationOfficial);

        return new OfficialShowResource($myFoundationOfficial);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Module\MyFoundation\Models\MyFoundationOfficial $myFoundationOfficial
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MyFoundationOfficial $myFoundationOfficial)
    {
        Gate::authorize('update', $myFoundationOfficial);

        $request->validate([]);

        return MyFoundationOfficial::updateRecord($request, $myFoundationOfficial);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Module\MyFoundation\Models\MyFoundationOfficial $myFoundationOfficial
     * @return \Illuminate\Http\Response
     */
    public function destroy(MyFoundationOfficial $myFoundationOfficial)
    {
        Gate::authorize('delete', $myFoundationOfficial);

        return MyFoundationOfficial::deleteRecord($myFoundationOfficial);
    }

    /**
     * Restore the specified resource from soft-delete.
     *
     * @param  \Module\MyFoundation\Models\MyFoundationOfficial $myFoundationOfficial
     * @return \Illuminate\Http\Response
     */
    public function restore(MyFoundationOfficial $myFoundationOfficial)
    {
        Gate::authorize('restore', $myFoundationOfficial);

        return MyFoundationOfficial::restoreRecord($myFoundationOfficial);
    }

    /**
     * Force Delete the specified resource from soft-delete.
     *
     * @param  \Module\MyFoundation\Models\MyFoundationOfficial $myFoundationOfficial
     * @return \Illuminate\Http\Response
     */
    public function forceDelete(MyFoundationOfficial $myFoundationOfficial)
    {
        Gate::authorize('destroy', $myFoundationOfficial);

        return MyFoundationOfficial::destroyRecord($myFoundationOfficial);
    }
}
