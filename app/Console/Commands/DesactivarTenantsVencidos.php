<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Tenant; // Asegúrate de que este es el modelo correcto
use Carbon\Carbon;

class DesactivarTenantsVencidos extends Command
{
    protected $signature = 'tenants:desactivar-vencidos';
    protected $description = 'Desactiva tenants cuya fecha de vencimiento ya pasó';

    public function handle()
    {
        $hoy = Carbon::today();

        $tenantsVencidos = Tenant::whereDate('fecha_vencimiento', '<', $hoy)
            ->where('activo', true)
            ->get();

        foreach ($tenantsVencidos as $tenant) {
            $tenant->activo = false;
            $tenant->save();

            $this->info("Tenant desactivado: {$tenant->id}");
        }

        $this->info("Total de tenants desactivados: " . $tenantsVencidos->count());
    }
}
