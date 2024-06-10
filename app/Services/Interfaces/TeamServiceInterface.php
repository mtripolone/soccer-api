<?php

namespace App\Services\Interfaces;

use Illuminate\Support\Collection;

interface TeamServiceInterface
{
    public function all(): Collection;
    public function create(array $data);
    public function findById(int $id);
}