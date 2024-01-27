<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class Service extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:service {service}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a service class';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $service = $this->argument('service');
        $parts = explode('/', $service);
        $serviceName = end($parts);
        $servicePath = app_path('Http/Service/' . implode('/', array_slice($parts, 0, -1)));

        if (!file_exists($servicePath)) {
            mkdir($servicePath, 0777, true);
        }

        $serviceFile = $servicePath . '/' . $serviceName . 'Service.php';

        if (file_exists($serviceFile)) {
            $this->error($serviceFile . ' already exists!');
            return;
        }

        $filecontent = file_get_contents(app_path('Console/Commands/stubs/service.stub'));
        $filecontent = str_replace('Template', 'App\Http\Service\\' . implode('\\', array_slice($parts, 0, -1)), $filecontent);
        $filecontent = str_replace('ServiceClass', $serviceName . 'Service', $filecontent);
        file_put_contents($serviceFile, $filecontent);
        $this->info('Service created successfully!');
        return 0;
    }
}
