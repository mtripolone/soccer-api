<?php

namespace App\Services\Interfaces;

use Illuminate\Support\Collection;

interface PlayerServiceInterface
{
    public function all(): Collection;
    public function create(array $data);
    public function findById(int $id);
    public function update(int $id, array $data);
    public function delete(int $id);
}