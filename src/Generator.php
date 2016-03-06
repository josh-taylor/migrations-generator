<?php

namespace Josh\MigrationsGenerator;

use Illuminate\Database\DatabaseManager as DB;

class Generator
{
    protected $describer;

    protected $db;

    public function __construct(Describer $describer, DB $db)
    {
        $this->describer = $describer;
        $this->db = $db;
    }

    public function tables()
    {
        $schema = $this->db->connection()
            ->getDoctrineConnection()
            ->getSchemaManager();

        $tables = $schema->listTableNames();

        foreach ($tables as $table) {
            $columns = $this->describer->describe($table);

            yield compact('table', 'columns');
        }
    }
}
