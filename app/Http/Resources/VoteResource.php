<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VoteResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'participant' => ParticipantResource::make($this->whenLoaded('participant')),
            'user' => UserResource::make($this->whenLoaded('user')),
            'contest_level' => ContestLevelResource::make($this->whenLoaded('contestLevel')),
        ];
    }
}
