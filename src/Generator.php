<?php

namespace JoshTaylor\MigrationsGenerator;

use Illuminate\Database\DatabaseManager as DB;

class Generator
{
    /**
     * @var Describer
     */
    protected $describer;

    /**
     * @var DB
     */
    protected $db;

    /**
     * Generator constructor.
     *
     * @param Describer $describer
     * @param DB $db
     */
    public function __construct(Describer $describer, DB $db)
    {
        $this->describer = $describer;
        $this->db = $db;
    }

    /**
     * Return a description for each table.
     *
     * @return \Generator
     */
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
