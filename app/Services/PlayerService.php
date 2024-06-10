<?php

namespace App\Services;

use App\Repositories\Interfaces\PlayerRepositoryInterface;
use App\Services\Interfaces\PlayerServiceInterface;
use Illuminate\Support\Collection;

class PlayerService implements PlayerServiceInterface
{
    protected $playerRepository;

    public function __construct(PlayerRepositoryInterface $playerRepository)
    {
        $this->playerRepository = $playerRepository;
    }

    public function all() : collection
    {
        return $this->playerRepository->all();
    }

    public function create(array $data)
    {
        return $this->playerRepository->create($data);
    }

    public function findById(int $id)
    {
        return $this->playerRepository->findById($id);
    }

    public function update(int $id, array $data)
    {
        return $this->playerRepository->update($id, $data);
    }

    public function delete(int $id)
    {
        return $this->playerRepository->delete($id);
    }
}