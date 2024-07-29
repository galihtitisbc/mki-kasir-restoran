<?php

namespace App\Trait;

use App\Models\User;
use Auth;

trait UserAndRoleLoggedIn
{
    public function getSupervisor(): User
    {
        $currentUser = Auth::getUser();
        $userReturn = '';
        if ($currentUser->getRoleNames()->implode(', ') != 'ADMIN') {
            $userReturn = $currentUser;
        } else {
            $userReturn = User::where('user_id', $currentUser->supervisor_id)->first();
        }
        return $userReturn;
    }
    public function getRole()
    {
        $currentUser = Auth::getUser();
        return $currentUser->getRoleNames()->implode(', ');
    }
}
