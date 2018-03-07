<?php

namespace Rawson\Shared\Models\Traits;

trait Intercom
{
    public function getIntercomHmacAttribute()
    {
        return hash_hmac('sha256', $this->email, config('intercom.secret'));
    }
}
