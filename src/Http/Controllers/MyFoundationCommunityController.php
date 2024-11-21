<?php

namespace Module\MyFoundation\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Module\MyFoundation\Models\MyFoundationCommunity;
use Module\MyFoundation\Http\Resources\CommunityCollection;
use Module\MyFoundation\Http\Resources\CommunityShowResource;

class MyFoundationCommunityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        Gate::authorize('view', MyFoundationCommunity::class);

        return new CommunityCollection(
            MyFoundationCommunity::forCurrentUser($request->user())
                ->applyMode($request->mode)
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
        Gate::authorize('create', MyFoundationCommunity::class);

        $request->validate([]);

        return MyFoundationCommunity::storeRecord($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Module\MyFoundation\Models\MyFoundationCommunity $myFoundationCommunity
     * @return \Illuminate\Http\Response
     */
    public function show(MyFoundationCommunity $myFoundationCommunity)
    {
        Gate::authorize('show', $myFoundationCommunity);

        return new CommunityShowResource($myFoundationCommunity);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Module\MyFoundation\Models\MyFoundationCommunity $myFoundationCommunity
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MyFoundationCommunity $myFoundationCommunity)
    {
        Gate::authorize('update', $myFoundationCommunity);

        $request->validate([]);

        return MyFoundationCommunity::updateRecord($request, $myFoundationCommunity);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Module\MyFoundation\Models\MyFoundationCommunity $myFoundationCommunity
     * @return \Illuminate\Http\Response
     */
    public function destroy(MyFoundationCommunity $myFoundationCommunity)
    {
        Gate::authorize('delete', $myFoundationCommunity);

        return MyFoundationCommunity::deleteRecord($myFoundationCommunity);
    }

    /**
     * Restore the specified resource from soft-delete.
     *
     * @param  \Module\MyFoundation\Models\MyFoundationCommunity $myFoundationCommunity
     * @return \Illuminate\Http\Response
     */
    public function restore(MyFoundationCommunity $myFoundationCommunity)
    {
        Gate::authorize('restore', $myFoundationCommunity);

        return MyFoundationCommunity::restoreRecord($myFoundationCommunity);
    }

    /**
     * Force Delete the specified resource from soft-delete.
     *
     * @param  \Module\MyFoundation\Models\MyFoundationCommunity $myFoundationCommunity
     * @return \Illuminate\Http\Response
     */
    public function forceDelete(MyFoundationCommunity $myFoundationCommunity)
    {
        Gate::authorize('destroy', $myFoundationCommunity);

        return MyFoundationCommunity::destroyRecord($myFoundationCommunity);
    }
}
