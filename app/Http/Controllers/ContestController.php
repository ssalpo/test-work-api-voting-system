<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContestRequest;
use App\Http\Resources\ContestResource;
use App\Models\Contest;
use App\Services\ContestService;
use Illuminate\Http\Request;

class ContestController extends Controller
{
    public function __construct(
        private readonly ContestService $contestService
    )
    {
    }

    public function index()
    {
        $contests = Contest::with('contestLevels')->get();

        return ContestResource::collection($contests);
    }

    public function store(ContestRequest $request)
    {
        return ContestResource::make(
            $this->contestService->store($request->validated())
        );
    }
}
