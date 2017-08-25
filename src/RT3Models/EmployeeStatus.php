<?php

namespace Rawson\Shared\RT3Models;

class EmployeeStatus extends Model
{
    protected $table = 'employeestatus';

    const ACTIVE = 1;
    const SABATICAL = 2;
    const RESIGNED = 3;
    const RESIGNEDRELOCATED = 4;
}
