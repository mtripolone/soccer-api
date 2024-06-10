<?php

namespace App\Http\Controllers;

use App\Services\Interfaces\TeamServiceInterface;

class TeamController extends Controller
{
    protected $teamService;

    public function __construct(TeamServiceInterface $teamService)
    {
        $this->teamService = $teamService;
    }

    public function index()
    {
        return response()->json($this->teamService->all());
    }

    public function show($id)
    {
        return response()->json($this->teamService->findById($id));
    }
  
}