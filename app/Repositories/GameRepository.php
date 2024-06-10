<?php

namespace App\Repositories;

use App\Models\Game;
use App\Repositories\Interfaces\GameRepositoryInterface;
use Illuminate\Support\Collection;

class GameRepository implements GameRepositoryInterface
{
    public function all(): Collection
    {
        return Game::all();
    }

    public function create(array $data)
    {
        return Game::create($data);
    }

    public function findById(int $id)
    {
        return Game::find($id);
    }
}