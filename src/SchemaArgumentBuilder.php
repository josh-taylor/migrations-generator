<?php

namespace JoshTaylor\MigrationsGenerator;

class SchemaArgumentBuilder
{
    /**
     * Return the argument string to use for the migration command.
     *
     * @param $schema
     * @return string
     */
    public function create($schema)
    {
        $types = array_map(function ($column) {
            return $column['name'] . ':' . $column['type'];
        }, $schema);

        return implode(', ', $types);
    }
}
