<?php

namespace App\Repositories;

use App\Models\Player;
use App\Repositories\Interfaces\PlayerRepositoryInterface;
use Illuminate\Support\Collection;

class PlayerRepository implements PlayerRepositoryInterface
{
    public function all(): Collection
    {
        return Player::all();
    }

    public function create(array $data)
    {
        return Player::create($data);
    }

    public function findById(int $id)
    {
        return Player::find($id);
    }

    public function update(int $id, array $data)
    {
        $player = Player::find($id);
        $player->update($data);
        return $player;
    }

    public function delete(int $id)
    {
        return Player::destroy($id);
    }
}