<?php

use Josh\MigrationsGenerator\SchemaArgumentBuilder;

class SchemaArgumentBuilderTest extends TestCase
{
    /** @test */
    public function it_should_build_the_correct_schema_arguments()
    {
        $builder = new SchemaArgumentBuilder;

        $arguments = $builder->create(
            [['name' => 'title', 'type' => 'string'], ['name' => 'body', 'type' => 'text']]
        );

        $this->assertEquals('title:string, body:text', $arguments);
    }
}
