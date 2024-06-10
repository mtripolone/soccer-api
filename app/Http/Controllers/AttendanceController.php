<?php

namespace App\Http\Controllers;

use App\Services\Interfaces\AttendanceServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AttendanceController extends Controller
{
    protected $attendanceService;

    public function __construct(AttendanceServiceInterface $attendanceService)
    {
        $this->attendanceService = $attendanceService;
    }

    public function index()
    {
        return response()->json($this->attendanceService->all());
    }

    public function store(Request $request)
    {
        $validatedData = Validator::make($request->all(), [
            'player_id' => 'required|integer|min:1',
            'confirmed' => 'required|boolean'
        ]);

        if ($validatedData->fails()) {
            return response()->json($validatedData->getMessageBag(), 400);
        }

        return response()->json($this->attendanceService->create($validatedData->valid()), 201);
    }

    public function show($id)
    {
        return response()->json($this->attendanceService->findById($id));
    }

    public function update(Request $request, $id)
    {
        $validatedData =Validator::make($request->all(), [
            'confirmed' => 'required|boolean'
        ]);

        if ($validatedData->fails()) {
            return response()->json($validatedData->getMessageBag(), 400);
        }

        return response()->json($this->attendanceService->update($id, $validatedData->valid()));
    }

    public function destroy($id)
    {
        try {
            $attendance = $this->attendanceService->findById($id);

            if (!$attendance) {
                return response()->json(['error' => 'Não encontrado.'], 404);
            }

            $this->attendanceService->delete($id);
            return response()->json(['message' => 'Presença excluída com sucesso.'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao excluir presença: ' . $e->getMessage()], 400);
        }
    }
  
}