<?php

namespace App\Repositories\Interfaces;

use Illuminate\Support\Collection;

interface GameRepositoryInterface
{
    public function create(array $data);
    public function findById(int $id);
    public function all(): Collection;
}