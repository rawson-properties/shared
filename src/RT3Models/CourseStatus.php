<?php

namespace Rawson\Shared\RT3Models;

class CourseStatus extends Model
{
    protected $table = 'coursestatus';

    const SCHEDULED = 1;
    const ATTENDED = 11;
    const COMPETENT = 21;
    const NOT_COMPETENT = 31;
}
