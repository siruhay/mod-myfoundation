<?php

namespace Module\MyFoundation\Policies;

use Module\System\Models\SystemUser;
use Module\MyFoundation\Models\MyFoundationCommunity;
use Illuminate\Auth\Access\Response;

class MyFoundationCommunityPolicy
{
    /**
    * Perform pre-authorization checks.
    */
    public function before(SystemUser $user, string $ability): bool|null
    {
        if ($user->hasLicenseAs('myfoundation-superadmin')) {
            return true;
        }

        return null;
    }

    /**
     * Determine whether the user can view any models.
     */
    public function view(SystemUser $user): bool
    {
        return $user->hasPermission('view-myfoundation-community');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function show(SystemUser $user, MyFoundationCommunity $myFoundationCommunity): bool
    {
        return $user->hasPermission('show-myfoundation-community');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(SystemUser $user): bool
    {
        return $user->hasPermission('create-myfoundation-community');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(SystemUser $user, MyFoundationCommunity $myFoundationCommunity): bool
    {
        return $user->hasPermission('update-myfoundation-community');
    }

    /**
     * Determine whether the user can upload the model.
     */
    public function upload(SystemUser $user, MyFoundationCommunity $myFoundationCommunity): bool
    {
        return $myFoundationCommunity->official_id === $user->userable->id && $user->hasPermission('update-myfoundation-community');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(SystemUser $user, MyFoundationCommunity $myFoundationCommunity): bool
    {
        return $user->hasPermission('delete-myfoundation-community');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(SystemUser $user, MyFoundationCommunity $myFoundationCommunity): bool
    {
        return $user->hasPermission('restore-myfoundation-community');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function destroy(SystemUser $user, MyFoundationCommunity $myFoundationCommunity): bool
    {
        return $user->hasPermission('destroy-myfoundation-community');
    }
}
