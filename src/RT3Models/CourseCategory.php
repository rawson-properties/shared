<?php

namespace Rawson\Shared\RT3Models;

class CourseCategory extends Model
{
    protected $table = 'coursecategory';

    const NONE = 1;
    const BIG = 11;
    const INFO_SESSIONS = 21;
    const REAL_ESTATE_RELATED = 31;
    const NON_REAL_ESTATE = 41;
    const REAL_ESTATE = 51;
    const MANAGEMENT_TRAINING = 61;
    const INFORMATION_SESSIONS = 71;
}
