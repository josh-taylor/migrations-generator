<?php

namespace Josh\MigrationsGenerator;

use DB;
use Illuminate\Console\Command;
use Josh\MigrationsGenerator\Describer;

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
        $schema = DB::connection()
            ->getDoctrineConnection()
            ->getSchemaManager();

        $tables = $schema->listTableNames();

        $describer = new Describer;

        foreach ($tables as $table) {
            $columns = $describer->describe($table);

            $types = array_map(function ($column) {
                return $column['name'] . ':' . $column['type'];
            });

            $this->call('make:migration:schema', [
                'name' => 'create_' . $table . '_table',
                '--schema' => implode($types, ', '),
                '--model' => false
            ]);
        }
    }
}

