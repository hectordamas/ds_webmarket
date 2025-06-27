<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Stancl\Tenancy\Tenancy;

class SeedTenant extends Command
{
    protected $signature = 'tenant:seed {tenant} {--class=TenantSeeder}';
    protected $description = 'Ejecutar un seeder dentro del contexto de un tenant específico';

    public function handle()
    {
        $tenantId = $this->argument('tenant');
        $seederClass = $this->option('class');

        $tenancy = app(Tenancy::class);
        $tenant = $tenancy->find($tenantId);

        if (! $tenant) {
            $this->error("Tenant no encontrado: $tenantId");
            return Command::FAILURE;
        }

        $this->info("Ejecutando seeder '$seederClass' para tenant '$tenantId'...");

        tenancy()->initialize($tenant);

        try {
            \Artisan::call('db:seed', [
                '--class' => $seederClass,
                '--force' => true,
            ]);

            $this->info("Seeder ejecutado correctamente para el tenant $tenantId.");
        } catch (\Exception $e) {
            $this->error("Error: " . $e->getMessage());
        } finally {
            tenancy()->end();
        }

        return Command::SUCCESS;
    }
}
