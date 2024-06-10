<?php

namespace App\Services;

use App\Models\Attendance;
use App\Repositories\Interfaces\GameRepositoryInterface;
use App\Repositories\Interfaces\TeamRepositoryInterface;
use App\Services\Interfaces\GameServiceInterface;
use Illuminate\Support\Collection;

class GameService implements GameServiceInterface
{
    protected $gameRepository;
    protected $teamRepository;

    public function __construct(GameRepositoryInterface $gameRepository, TeamRepositoryInterface $teamRepository)
    {
        $this->gameRepository = $gameRepository;
        $this->teamRepository = $teamRepository;
    }

    public function createTeams(int $playersPerTeam): Collection
    {
        $attendances = Attendance::where('confirmed', true)->with('player')->get();

        if ($attendances->count() < $playersPerTeam * 2) {
            throw new \Exception('Jogadores insuficientes');
        }

        $goalkeepers = $attendances->filter(fn($attendance) => $attendance->player->goalkeeper)->shuffle();
        $fieldPlayers = $attendances->filter(fn($attendance) => !$attendance->player->goalkeeper)->shuffle();

        if ($goalkeepers->count() < 2) {
            throw new \Exception('Goleiros insuficientes');
        }

        $teams = collect();
        $totalTeams = floor($goalkeepers->count() / 2);
        $teamCounter = 1;

        while ($teams->count() < $totalTeams * 2) {
            $team1 = [
                'name' => "Time $teamCounter",
                'goalkeeper' => $goalkeepers->pop()->player,
                'fieldPlayers' => $this->getBalancedPlayers($fieldPlayers, $playersPerTeam - 1),
            ];

            $teamCounter++;

            $team2 = [
                'name' => "Time $teamCounter",
                'goalkeeper' => $goalkeepers->pop()->player,
                'fieldPlayers' => $this->getBalancedPlayers($fieldPlayers, $playersPerTeam - 1),
            ];

            $teamCounter++;

            $teams->push($team1);
            $teams->push($team2);
        }

        $game = $this->gameRepository->create(['teams' => $teams->toJson()]);

        foreach ($teams as $team) {
            $this->teamRepository->create([
                'game_id' => $game->id,
                'players' => json_encode($team)
            ]);
        }

        return $teams;
    }

    private function getBalancedPlayers(Collection $fieldPlayers, int $count): Collection
    {
        $selectedPlayers = collect();
        $totalSkill = $fieldPlayers->pluck('player.skill')->sum();
        $averageSkill = $totalSkill / $fieldPlayers->count();

        for ($i = 0; $i < $count; $i++) {
            $bestPlayer = $fieldPlayers->first(function ($attendance) use ($averageSkill) {
                return $attendance->player->skill >= $averageSkill;
            });

            if ($bestPlayer) {
                $selectedPlayers->push($bestPlayer->player);
                $fieldPlayers = $fieldPlayers->reject(function ($attendance) use ($bestPlayer) {
                    return $attendance->player->id === $bestPlayer->player->id;
                });
            } else {
                $bestPlayer = $fieldPlayers->pop();
                $selectedPlayers->push($bestPlayer->player);
            }
        }

        return $selectedPlayers;
    }
}