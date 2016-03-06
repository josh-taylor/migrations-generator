<?php

use Illuminate\Database\Capsule\Manager as DB;

abstract class TestCase extends PHPUnit_Framework_TestCase
{
    protected $database;

    public function setUp()
    {
        $this->setUpDatabase();
        $this->migrateTables();
    }

    protected function setUpDatabase()
    {
        $this->database = new DB;

        $this->database->addConnection(['driver' => 'sqlite', 'database' => ':memory:']);
        $this->database->bootEloquent();
        $this->database->setAsGlobal();
    }

    protected function migrateTables()
    {
        DB::schema()->create('posts', function ($table) {
            $table->increments('id');
            $table->string('title', 100);
            $table->text('body');
            $table->timestamps();
        });

        DB::schema()->create('users', function ($table) {
            $table->increments('id');
            $table->integer('group_id');
            $table->string('username');
            $table->string('password');
            $table->timestamps();
        });
    }
}
