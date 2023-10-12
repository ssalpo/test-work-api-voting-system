<?php

namespace App\Http\Controllers;

use App\Http\Requests\ParticipantRequest;
use App\Http\Resources\ParticipantResource;
use App\Models\Participant;
use App\Services\ParticipantService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ParticipantController extends Controller
{
    public function __construct(
        private readonly ParticipantService $participantService
    )
    {
    }

    public function index(): AnonymousResourceCollection
    {
        return ParticipantResource::collection(
            Participant::filter(request('sort'))->get()
        );
    }


    public function store(ParticipantRequest $request): ParticipantResource
    {
        return ParticipantResource::make(
            $this->participantService->store(
                $request->validated() + ['avatar' => $request->file('avatar')]
            )
        );
    }
}
