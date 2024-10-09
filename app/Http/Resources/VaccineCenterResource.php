<?php

namespace App\Http\Resources;

use App\Models\VaccineCenter;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin VaccineCenter */
class VaccineCenterResource extends JsonResource
{
    public function toArray(Request $request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'location' => $this->location,
            'daily_capacity' => $this->daily_capacity,
        ];
    }
}
