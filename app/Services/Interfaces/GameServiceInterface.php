<?php

namespace App\Services\Interfaces;

use Illuminate\Support\Collection;

interface GameServiceInterface
{
    public function createTeams(int $playersPerTeam): Collection;
}