<?php

namespace Josh\MigrationsGenerator;

use Illuminate\Database\DatabaseManager as DB;

class Describer
{
    /**
     * The instance of the database manager.
     *
     * @var DB
     */
    protected $db;

    /**
     * The constructor.
     *
     * @param DB $db
     */
    public function __construct(DB $db)
    {
        $this->db = $db;
    }

    /**
     * Describe all columns in a single table
     *
     * @param string $table
     */
    public function describe($table)
    {
        $schema = $this->db->connection()
            ->getDoctrineConnection()
            ->getSchemaManager();

        return $this->parseSchema($schema->listTableColumns($table));
    }

    /**
     * Convert the DBAL schema to an assoc array.
     *
     * @param array $columns
     */
    protected function parseSchema(array $columns)
    {
        $schema = [];

        foreach ($columns as $name => $column) {
            $schema[] = [
                'name' => $name,
                'type' => $column->getType()->getName()
            ];
        }

        return $schema;
    }
}
