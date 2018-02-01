<?php

namespace Rawson\Shared\RT3Models;

use Rawson\Shared\Libs\Hubspot;

class Agent extends Model
{
    protected $table = 'agentlist';
    protected $dates = [
        'UPDATED',
    ];

    public function getName(): string
    {
        return $this->employee->person->FULLNAME;
    }

    public function getEmail(): string
    {
        return $this->employee->person->EMAIL;
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'EMPLOYEEID', 'ID');
    }

    public function office()
    {
        return $this->belongsTo(Office::class, 'OFFICEID', 'ID');
    }
}
