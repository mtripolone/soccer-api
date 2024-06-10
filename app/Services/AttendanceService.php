<?php

namespace App\Services;

use App\Repositories\Interfaces\AttendanceRepositoryInterface;
use App\Repositories\Interfaces\PlayerRepositoryInterface;
use App\Services\Interfaces\AttendanceServiceInterface;
use App\Services\Interfaces\PlayerServiceInterface;
use Illuminate\Support\Collection;

class AttendanceService implements AttendanceServiceInterface
{
    protected $attendanceRepository;

    public function __construct(AttendanceRepositoryInterface $playerRepository)
    {
        $this->attendanceRepository = $playerRepository;
    }

    public function all() : collection
    {
        return $this->attendanceRepository->all();
    }

    public function create(array $data)
    {
        return $this->attendanceRepository->create($data);
    }

    public function findById(int $id)
    {
        return $this->attendanceRepository->findById($id);
    }

    public function update(int $id, array $data)
    {
        return $this->attendanceRepository->update($id, $data);
    }

    public function delete(int $id)
    {
        return $this->attendanceRepository->delete($id);
    }
}