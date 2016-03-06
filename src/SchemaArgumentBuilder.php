<?php

namespace Josh\MigrationsGenerator;

class SchemaArgumentBuilder
{
    public function create($schema)
    {
        $types = array_map(function ($column) {
            return $column['name'] . ':' . $column['type'];
        }, $schema);

        return implode(', ', $types);
    }
}
