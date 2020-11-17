<?php

namespace Rawson\Shared\RT3Models;

class Course extends Model
{
    protected $table = 'course';

    public function courseCategory()
    {
        return $this->belongsTo(CourseCategory::class, 'COURSECATEGORYID', 'ID');
    }
}
