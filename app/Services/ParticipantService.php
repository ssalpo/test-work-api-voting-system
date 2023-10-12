<?php

namespace App\Services;

use App\Models\Participant;

class ParticipantService
{
    public const AVATARS_PATH = 'public/avatars/participant';

    public function store(array $data)
    {
        $data['avatar'] = $data['avatar']?->store(self::AVATARS_PATH);

        return Participant::create($data);
    }
}
