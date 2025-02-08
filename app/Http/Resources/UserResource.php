<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'type' => 'users',
            'id' => (string) $this->id,
            'attributes' => [
                'name' => $this->name,
                'surname' => $this->surname,
                'full_name' => $this->full_name,
                'email' => $this->email,
                'current_cafe_id' => (string) $this->current_cafe_id,
            ],
            'relationships' => [
                'cafes' => CafeResource::collection($this->whenLoaded('cafes')),
            ],
        ];
    }

    public function withCafes(): static
    {
        return tap($this, fn () => $this->loadMissing('cafes'));
    }
}
