<?php

namespace App\Http\Controllers;

use App\Http\Requests\VoteRequest;
use App\Http\Resources\VoteResource;
use App\Models\Vote;
use App\Services\VoteService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class VoteController extends Controller
{
    public const WITH_RELATIONS = ['participant', 'user', 'contestLevel'];

    public function __construct(
        public readonly VoteService $voteService
    )
    {
    }

    public function index(): AnonymousResourceCollection
    {
        $votes = Vote::with(self::WITH_RELATIONS)->get();

        return VoteResource::collection($votes);
    }

    /**
     * @throws \Exception
     */
    public function store(VoteRequest $request): VoteResource
    {
        $vote = $this->voteService->store($request->validated());

        return VoteResource::make(
            $vote->load(self::WITH_RELATIONS)
        );
    }
}
