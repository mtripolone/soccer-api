<?php

namespace App\Services;

use App\Repositories\Interfaces\TeamRepositoryInterface;
use App\Services\Interfaces\TeamServiceInterface;
use Illuminate\Support\Collection;

class TeamService implements TeamServiceInterface
{
    protected $teamRepository;

    public function __construct(TeamRepositoryInterface $teamRepository)
    {
        $this->teamRepository = $teamRepository;
    }

    public function all() : collection
    {
        return $this->teamRepository->all();
    }

    public function create(array $data)
    {
        return $this->teamRepository->create($data);
    }

    public function findById(int $id)
    {
        return $this->teamRepository->findById($id);
    }
}