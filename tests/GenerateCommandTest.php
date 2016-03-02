<?php

use Josh\MigrationsGenerator\GenerateCommand;

class GenerateCommandTest extends TestCase
{
    /** @test */
    public function it_should_generate_the_proper_migrations()
    {
        $command = new GenerateCommand();

        $command->handle();
    }
}
