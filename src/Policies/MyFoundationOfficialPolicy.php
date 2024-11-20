<?php

namespace Module\MyFoundation\Policies;

use Module\System\Models\SystemUser;
use Module\MyFoundation\Models\MyFoundationOfficial;
use Illuminate\Auth\Access\Response;

class MyFoundationOfficialPolicy
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
        return $user->hasPermission('view-myfoundation-official');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function show(SystemUser $user, MyFoundationOfficial $myFoundationOfficial): bool
    {
        return $user->hasPermission('show-myfoundation-official');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(SystemUser $user): bool
    {
        return $user->hasPermission('create-myfoundation-official');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(SystemUser $user, MyFoundationOfficial $myFoundationOfficial): bool
    {
        return $user->hasPermission('update-myfoundation-official');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(SystemUser $user, MyFoundationOfficial $myFoundationOfficial): bool
    {
        return $user->hasPermission('delete-myfoundation-official');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(SystemUser $user, MyFoundationOfficial $myFoundationOfficial): bool
    {
        return $user->hasPermission('restore-myfoundation-official');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function destroy(SystemUser $user, MyFoundationOfficial $myFoundationOfficial): bool
    {
        return $user->hasPermission('destroy-myfoundation-official');
    }
}
