<?php

namespace Josh\MigrationsGenerator;

use Illuminate\Database\DatabaseManager as DB;

class Describer
{
    protected $db;

    public function __construct(DB $db)
    {
        $this->db = $db;
    }

    public function describe($table)
    {
        return $this->db->select('PRAGMA table_info(?)', [$table]);
    }
}
