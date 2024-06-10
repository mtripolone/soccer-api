<?php

namespace App\Http\Controllers;

use App\Services\Interfaces\PlayerServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Stmt\Catch_;

class PlayerController extends Controller
{
    protected $playerService;

    public function __construct(PlayerServiceInterface $playerService)
    {
        $this->playerService = $playerService;
    }

    public function index()
    {
        return response()->json($this->playerService->all());
    }

    public function store(Request $request)
    {
        $validatedData = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'level' => 'required|integer|min:1|max:5',
            'goalkeeper' => 'required|boolean',
        ]);

        if ($validatedData->fails()) {
            return response()->json($validatedData->getMessageBag(), 400);
        }

        return response()->json($this->playerService->create($validatedData->valid()), 201);
    }

    public function show($id)
    {
        return response()->json($this->playerService->findById($id));
    }

    public function update(Request $request, $id)
    {
        $validatedData = Validator::make($request->all(), [
            'name' => 'sometimes|required|string|max:255',
            'level' => 'sometimes|required|integer|min:1|max:5',
            'goalkeeper' => 'sometimes|required|boolean',
        ]);

        if ($validatedData->fails()) {
            return response()->json($validatedData->getMessageBag(), 400);
        }

        return response()->json($this->playerService->update($id, $validatedData->valid()));
    }

    public function destroy($id)
    {
        try {
            $player = $this->playerService->findById($id);

            if (!$player) {
                return response()->json(['error' => 'Jogador não encontrado.'], 404);
            }

            $this->playerService->delete($id);
            return response()->json(['message' => 'Jogador excluído com sucesso.'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao excluir o jogador: ' . $e->getMessage()], 400);
        }
    }
}