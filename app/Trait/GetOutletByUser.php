<?php

namespace App\Trait;

use Auth;

trait GetOutletByUser
{
    use UserAndRoleLoggedIn;
    public function getOutletByUser()
    {
        if ($this->getRole() == 'ADMIN') {
            $outlet = Auth::getUser()->outletWorks()->get();
        } else {
            $outlet = Auth::getUser()->supervisorHasOutlets()->get();
        }
        return $outlet;
    }
}
