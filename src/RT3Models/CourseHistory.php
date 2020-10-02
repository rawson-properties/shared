<?php

namespace Rawson\Shared\RT3Models;

class CourseHistory extends Model
{
    protected $table = 'coursehistory';

    protected $dates = [
        'STARTDATE',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'EMPLOYEEID', 'ID');
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'COURSEDESCRIPTIONID', 'ID');
    }

    public function courseStatus()
    {
        return $this->belongsTo(CourseStatus::class, 'COURSESSTATUSID', 'ID');
    }
}
