<?php

namespace App\Repositories;

use App\Models\Team;
use App\Repositories\Interfaces\TeamRepositoryInterface;
use Illuminate\Support\Collection;

class TeamRepository implements TeamRepositoryInterface
{
    public function all(): Collection
    {
        return Team::all();
    }
    public function create(array $data)
    {
        return Team::create($data);
    }

    public function findById(int $gameId): Collection
    {
        return Team::where('game_id', $gameId)->get();
    }
}