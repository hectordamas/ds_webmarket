<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Console\Commands\DesactivarTenantsVencidos; // <--- IMPORTANTE

class Kernel extends ConsoleKernel
{
    protected $commands = [
        DesactivarTenantsVencidos::class,
    ];

    protected function schedule(Schedule $schedule)
    {
        $schedule->command('tenants:desactivar-vencidos')->daily(); // Ejecutar cada día
    }

    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
