<?php

namespace Module\MyFoundation\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Module\MyFoundation\Models\MyFoundationMember;
use Module\MyFoundation\Models\MyFoundationCommunity;
use Module\MyFoundation\Http\Resources\MemberCollection;
use Module\MyFoundation\Http\Resources\MemberShowResource;

class MyFoundationMemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Module\MyFoundation\Models\MyFoundationCommunity $myFoundationCommunity
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, MyFoundationCommunity $myFoundationCommunity)
    {
        Gate::authorize('view', MyFoundationMember::class);

        Log::info($myFoundationCommunity);

        return new MemberCollection(
            $myFoundationCommunity
                ->members()
                ->with(['position', 'service'])
                ->applyMode($request->mode)
                ->filter($request->filters)
                ->search($request->findBy)
                ->sortBy($request->sortBy, $request->sortDesc)
                ->paginate($request->itemsPerPage)
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Module\MyFoundation\Models\MyFoundationCommunity $myFoundationCommunity
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, MyFoundationCommunity $myFoundationCommunity)
    {
        Gate::authorize('create', MyFoundationMember::class);

        $request->validate([]);

        return MyFoundationMember::storeRecord($request, $myFoundationCommunity);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Module\MyFoundation\Models\MyFoundationCommunity $myFoundationCommunity
     * @param  \Module\MyFoundation\Models\MyFoundationMember $myFoundationMember
     * @return \Illuminate\Http\Response
     */
    public function show(MyFoundationCommunity $myFoundationCommunity, MyFoundationMember $myFoundationMember)
    {
        Gate::authorize('show', $myFoundationMember);

        return new MemberShowResource($myFoundationMember);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Module\MyFoundation\Models\MyFoundationCommunity $myFoundationCommunity
     * @param  \Module\MyFoundation\Models\MyFoundationMember $myFoundationMember
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MyFoundationCommunity $myFoundationCommunity, MyFoundationMember $myFoundationMember)
    {
        Gate::authorize('update', $myFoundationMember);

        $request->validate([]);

        return MyFoundationMember::updateRecord($request, $myFoundationMember, $myFoundationCommunity);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Module\MyFoundation\Models\MyFoundationCommunity $myFoundationCommunity
     * @param  \Module\MyFoundation\Models\MyFoundationMember $myFoundationMember
     * @return \Illuminate\Http\Response
     */
    public function destroy(MyFoundationCommunity $myFoundationCommunity, MyFoundationMember $myFoundationMember)
    {
        Gate::authorize('delete', $myFoundationMember);

        return MyFoundationMember::deleteRecord($myFoundationMember);
    }

    /**
     * Restore the specified resource from soft-delete.
     *
     * @param  \Module\MyFoundation\Models\MyFoundationMember $myFoundationMember
     * @return \Illuminate\Http\Response
     */
    public function restore(MyFoundationCommunity $myFoundationCommunity, MyFoundationMember $myFoundationMember)
    {
        Gate::authorize('restore', $myFoundationMember);

        return MyFoundationMember::restoreRecord($myFoundationMember);
    }

    /**
     * Force Delete the specified resource from soft-delete.
     *
     * @param  \Module\MyFoundation\Models\MyFoundationMember $myFoundationMember
     * @return \Illuminate\Http\Response
     */
    public function forceDelete(MyFoundationCommunity $myFoundationCommunity, MyFoundationMember $myFoundationMember)
    {
        Gate::authorize('destroy', $myFoundationMember);

        return MyFoundationMember::destroyRecord($myFoundationMember);
    }
}
