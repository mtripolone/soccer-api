<?php

namespace App\Http\Controllers;

use App\Services\Interfaces\GameServiceInterface;
use Illuminate\Http\Request;

class GameController extends Controller
{
    protected $gameService;

    public function __construct(GameServiceInterface $gameService)
    {
        $this->gameService = $gameService;
    }

    public function store(Request $request)
    {
        $request->validate([
            'players_per_team' => 'required|integer|min:1',
        ]);

        try {
            $teams = $this->gameService->createTeams($request->players_per_team);
            return response()->json($teams, 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}