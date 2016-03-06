<?php

namespace JoshTaylor\MigrationsGenerator;

use Illuminate\Console\Command;
use Illuminate\Database\DatabaseManager as DB;

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
     * @var DB
     */
    protected $db;

    /**
     * GenerateCommand constructor.
     *
     * @param DB $db
     */
    public function __construct(DB $db)
    {
        $this->db = $db;

        parent::__construct();
    }

    /**
     * Execute the console command
     */
    public function handle()
    {
        $generator = new Generator(
            new Describer($this->db), $this->db
        );

        foreach ($generator->tables() as $schema) {
            $this->callSilent('make:migration:schema', [
                'name' => 'create_' . $schema['table'] . '_table',
                '--schema' => (new SchemaArgumentBuilder)->create($schema['columns']),
                '--model' => false
            ]);
        }

        $this->info('Migrations created successfully');
    }
}

