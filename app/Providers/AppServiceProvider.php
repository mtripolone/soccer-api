<?php

namespace App\Providers;

use App\Repositories\AttendanceRepository;
use App\Repositories\GameRepository;
use App\Repositories\Interfaces\AttendanceRepositoryInterface;
use App\Repositories\Interfaces\GameRepositoryInterface;
use App\Repositories\Interfaces\PlayerRepositoryInterface;
use App\Repositories\Interfaces\TeamRepositoryInterface;
use App\Repositories\PlayerRepository;
use App\Repositories\TeamRepository;
use App\Services\AttendanceService;
use App\Services\GameService;
use App\Services\Interfaces\AttendanceServiceInterface;
use App\Services\Interfaces\GameServiceInterface;
use App\Services\Interfaces\PlayerServiceInterface;
use App\Services\Interfaces\TeamServiceInterface;
use App\Services\PlayerService;
use App\Services\TeamService;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(PlayerServiceInterface::class, PlayerService::class);
        $this->app->bind(GameServiceInterface::class, GameService::class);
        $this->app->bind(PlayerRepositoryInterface::class, PlayerRepository::class);
        $this->app->bind(GameRepositoryInterface::class, GameRepository::class);
        $this->app->bind(AttendanceServiceInterface::class, AttendanceService::class);
        $this->app->bind(AttendanceRepositoryInterface::class, AttendanceRepository::class);
        $this->app->bind(TeamRepositoryInterface::class, TeamRepository::class);
        $this->app->bind(TeamServiceInterface::class, TeamService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        ResetPassword::createUrlUsing(function (object $notifiable, string $token) {
            return config('app.frontend_url')."/password-reset/$token?email={$notifiable->getEmailForPasswordReset()}";
        });
    }
}
