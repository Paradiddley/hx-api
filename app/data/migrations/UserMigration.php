<?php

use Illuminate\Database\Capsule\Manager as Capsule;

class UserMigration
{
    public function run()
    {
        Capsule::schema()->dropIfExists('user');
        Capsule::schema()->create('user', function ($table) {
            $table->increments('id');
            $table->string('email')->unique();
            $table->string('forename');
            $table->string('surname');
            $table->timestamps();
        });
    }
}
