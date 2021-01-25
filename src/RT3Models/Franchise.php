<?php

namespace Rawson\Shared\RT3Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Rawson\Shared\Database\Factories\FranchiseFactory;

class Franchise extends Model
{
    use HasFactory;

    protected $table = 'franchise';

    protected static function newFactory()
    {
        return FranchiseFactory::new();
    }

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

    public function businessTypes(): BelongsToMany
    {
        return $this->belongsToMany(BusinessType::class, 'franchisebusinesstype', 'FRANCHISEID', 'BUSINESSTYPEID');
    }

    public function franchiseClassification(): BelongsTo
    {
        return $this->belongsTo(FranchiseClassification::class, 'FRANCHISECLASSIFICATIONID', 'ID');
    }

    public function stakeholder(): BelongsTo
    {
        return $this->belongsTo(Stakeholder::class, 'STAKEHOLDERID', 'ID');
    }
}
