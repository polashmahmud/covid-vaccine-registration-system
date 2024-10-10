<?php

namespace App\Http\Resources;

use App\Models\Registration;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

/** @mixin Registration */
class RegistrationResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'scheduled_date' => $this->scheduled_date->format('Y-m-d'),
            'status' => Str::title(Str::replace('_', ' ', $this->status)),
            'user' => new UserResource($this->whenLoaded('user')),
            'vaccineCenter' => new VaccineCenterResource($this->whenLoaded('vaccineCenter')),
        ];
    }
}
