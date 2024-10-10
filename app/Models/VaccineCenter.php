<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VaccineCenter extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable = [
        'name',
        'location',
        'daily_capacity',
    ];

    public function registrations(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Registration::class);
    }
}
