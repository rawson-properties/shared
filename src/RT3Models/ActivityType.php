<?php

namespace Rawson\Shared\RT3Models;

class ActivityType extends Model
{
    protected $table = 'activitytype';

    // This list is incomplete!
    const SHOWHOUSE = 41; // Listing Show house
    const LISTING_VIEWING = 43;
    const PROPERTY_VIEWING = 53;
    const PROPERTY_SHOWHOUSE = 55;
    const CONTACT_VIEWING = 61;
    const CONTACT_SHOWHOUSE = 63;
    const LISTING_SHOWHOUSE = 74;
}
