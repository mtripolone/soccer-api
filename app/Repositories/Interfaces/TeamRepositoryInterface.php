<?php

namespace App\Repositories\Interfaces;

use Illuminate\Support\Collection;

interface TeamRepositoryInterface
{
    public function all(): Collection;
    public function create(array $data);
    public function findById(int $gameId): Collection;
}