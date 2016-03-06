<?php

use JoshTaylor\MigrationsGenerator\Describer;

class DescriberTest extends TestCase
{
    /** @test */
    public function it_should_return_an_array_of_all_columns_for_a_table()
    {
        $describer = new Describer($this->database->getDatabaseManager());

        $description = $describer->describe('posts');

        $this->assertDbSchema(
            'id', 'integer', $description[0]
        );

        $this->assertDbSchema(
            'title', 'string', $description[1]
        );

        $this->assertDbSchema(
            'body', 'text', $description[2]
        );

        $this->assertDbSchema(
            'created_at', 'datetime', $description[3]
        );

        $this->assertDbSchema(
            'updated_at', 'datetime', $description[4]
        );
    }

    protected function assertDbSchema($name, $type, $row)
    {
        $this->assertEquals($name, $row['name'], 'Name field does not match');
        $this->assertEquals($type, $row['type'], 'Type field for ' . $row['name'] . ' does not match');
    }
}
