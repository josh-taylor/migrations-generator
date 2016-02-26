<?php

namespace Josh\MigrationsGenerator;

use Illuinate\Console\Command;

class GenerateCommand extends Command
{
    /**
     * The name and signature of the command
     *
     * @var string
     */
    protected $signature = 'migrate:generate
                            {--ignore= : Tables to not generate the schema files}';

    /**
     * The console command description
     *
     * @var string
     */
    protected $description = 'Generate migrations from your database schema';

    /**
     * Execute the console command
     */
    public function handle()
    {
        $this->call('make:migration:schema', [
            'create_posts_table',
            '--schema' => 'title:string, body:text'
        ]);
    }
}

