<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class Repository extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature =  'create:repository {repository}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make a repository for a model class';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $repository = $this->argument('repository');
        $parts = explode('/', $repository);
        $repositoryName = end($parts);
        $repositoryPath = app_path('Http/Repository/' . implode('/', array_slice($parts, 0, -1)));

        if (!file_exists($repositoryPath)) {
            mkdir($repositoryPath, 0777, true);
        }

        $repositoryFile = $repositoryPath . '/' . $repositoryName . 'Repository.php';

        if (file_exists($repositoryFile)) {
            $this->error('Repository already exists!');
            return;
        }

        $filecontenct = file_get_contents(app_path('Console/Commands/stubs/repository.stub'));
        $filecontenct = str_replace('{{repository}}', 'App\\Http\\Repository\\' . implode('\\', array_slice($parts, 0, -1)), $filecontenct);
        $filecontenct = str_replace('{{repositoryName}}', $repositoryName . 'Repository', $filecontenct);
        file_put_contents($repositoryFile, $filecontenct);
        $this->info('Repository created successfully!');
        return 0;
    }
}
