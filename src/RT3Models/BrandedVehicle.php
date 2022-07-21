<?php

namespace Rawson\Shared\RT3Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BrandedVehicle extends Model
{
    protected $table = 'brandedvehicle';

    protected $dates = [
        'BVRDATE',
        'STATUSDATE',
    ];

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'EMPLOYEEID', 'ID');
    }
}
