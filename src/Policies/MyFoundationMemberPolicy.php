<?php

namespace Module\MyFoundation\Policies;

use Module\System\Models\SystemUser;
use Module\MyFoundation\Models\MyFoundationMember;
use Illuminate\Auth\Access\Response;

class MyFoundationMemberPolicy
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
        return $user->hasPermission('view-myfoundation-member');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function show(SystemUser $user, MyFoundationMember $myFoundationMember): bool
    {
        return $user->hasPermission('show-myfoundation-member');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(SystemUser $user): bool
    {
        return $user->hasPermission('create-myfoundation-member');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(SystemUser $user, MyFoundationMember $myFoundationMember): bool
    {
        return $user->hasPermission('update-myfoundation-member');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(SystemUser $user, MyFoundationMember $myFoundationMember): bool
    {
        return $user->hasPermission('delete-myfoundation-member');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(SystemUser $user, MyFoundationMember $myFoundationMember): bool
    {
        return $user->hasPermission('restore-myfoundation-member');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function destroy(SystemUser $user, MyFoundationMember $myFoundationMember): bool
    {
        return $user->hasPermission('destroy-myfoundation-member');
    }
}
