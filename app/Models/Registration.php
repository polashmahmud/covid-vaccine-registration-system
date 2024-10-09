<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Registration extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable = [
        'scheduled_date',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function vaccineCenter()
    {
        return $this->belongsTo(VaccineCenter::class);
    }

    protected function casts()
    {
        return [
            'scheduled_date' => 'date',
        ];
    }
}
