<?php

use Josh\MigrationsGenerator\Describer;

class DescriberTest extends TestCase
{
    /** @test */
    public function it_should_return_an_array_of_all_columns_for_a_table()
    {
        $describer = new Describer($this->database->getDatabaseManager());

        $description = $describer->describe('posts');

        $this->assertEquals('id', $description[0]['name']);
        $this->assertEquals('integer', $description[0]['type']);

        $this->assertEquals('title', $description[1]['name']);
        $this->assertEquals('string', $description[1]['type']);
    }
}
