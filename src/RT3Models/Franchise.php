<?php

namespace Rawson\Shared\RT3Models;

class Franchise extends Model
{
    protected $table = 'franchise';

    public function getCountEmployeesAttribute(): int
    {
        return Employee::join('agentlist', 'agentlist.EMPLOYEEID', 'employee.ID')
            ->join('office', 'office.ID', 'agentlist.OFFICEID')
            ->where('office.FRANCHISEID', $this->ID)
            ->where('office.OFFICESTATUSID', OfficeStatus::ACTIVE)
            ->where('agentlist.ACTIVE', 'y')
            ->count()
            ;
    }

    public function businessTypes()
    {
        return $this->belongsToMany(BusinessType::class, 'franchisebusinesstype', 'FRANCHISEID', 'BUSINESSTYPEID');
    }

    public function stakeholder()
    {
        return $this->belongsTo(Stakeholder::class, 'STAKEHOLDERID', 'ID');
    }
}
