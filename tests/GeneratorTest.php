<?php

use Josh\MigrationsGenerator\Generator;

class GeneratorTest extends TestCase
{
    /** @test */
    public function it_should_return_all_descriptions_for_each_table()
    {
        $describer = $this->prophesize('Josh\MigrationsGenerator\Describer');

        $postsSchema = [['name' => 'id', 'type' => 'integer']];
        $usersSchema = [['name' => 'id', 'type' => 'integer']];

        $describer->describe('posts')
            ->shouldBeCalled()
            ->willReturn($postsSchema);

        $describer->describe('users')
            ->shouldBeCalled()
            ->willReturn($usersSchema);

        $generator =  new Generator($describer->reveal(), $this->database->getDatabaseManager());

        $tables = $generator->tables();

        $this->assertEquals('posts', $tables->current()['table']);
        $this->assertEquals($postsSchema, $tables->current()['columns']);

        $tables->next();

        $this->assertEquals('users', $tables->current()['table']);
        $this->assertEquals($usersSchema, $tables->current()['columns']);
    }
}
