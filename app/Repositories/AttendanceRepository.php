<?php

namespace App\Repositories;

use App\Models\Attendance;
use App\Repositories\Interfaces\AttendanceRepositoryInterface;
use Illuminate\Support\Collection;

class AttendanceRepository implements AttendanceRepositoryInterface
{
    public function all(): Collection
    {
        return Attendance::all();
    }

    public function create(array $data)
    {
        return Attendance::create($data);
    }

    public function findById(int $id)
    {
        return Attendance::find($id);
    }

    public function update(int $id, array $data)
    {
        $attendance = Attendance::find($id);
        $attendance->update($data);
        return $attendance;
    }

    public function delete(int $id)
    {
        return Attendance::destroy($id);
    }
}