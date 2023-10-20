<?php

namespace Rawson\Shared\Listeners;

use Rawson\Shared\RT3Models\JobTitle as RT3JobTitle;
use Rawson\Shared\RT3Models\Person as RT3Person;
use Illuminate\Auth\Events\Login;
use Log;

class UpdateUserRT3Link
{
    // On new user logins, check RT3 to connect an email to Person
    public function handle(Login $event)
    {
        $user = $event->user;
        $rt3Person = RT3Person
            ::select([ 'person.*' ])
            ->where('email', $user->email)
            ->where('JOBTITLEID', '!=', RT3JobTitle::NONE)
            ->join('employee', 'employee.PERSONID', 'person.ID')
            ->orderBy('UPDATED', 'DESC')
            ->first()
            ;

        if ($rt3Person && $user->rt3_person_id != $rt3Person->ID) {
            $user->rt3Person()->associate($rt3Person);
            $user->save();

            Log::debug(sprintf(
                'Linked User [%s] to RT3 Person [%s]',
                $user->id,
                $user->rt3_person_id
            ));
        }
    }
}
