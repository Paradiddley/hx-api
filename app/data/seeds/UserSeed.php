<?php

use Illuminate\Database\Capsule\Manager as Capsule;
use Carbon\Carbon;

class UserSeed
{
    public function run()
    {
        Capsule::table('user')->truncate();

        $data = [
            [
                'email' => 'homer@simpsons.com',
                'forename' => 'Homer',
                'surname' => 'Simpson',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'email' => 'marge@simpsons.com',
                'forename' => 'Marge',
                'surname' => 'Simpson',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'email' => 'bart@simpsons.com',
                'forename' => 'Bart',
                'surname' => 'Simpson',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'email' => 'lisa@simpsons.com',
                'forename' => 'Lisa',
                'surname' => 'Simpson',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'email' => 'maggie@simpsons.com',
                'forename' => 'Maggie',
                'surname' => 'Simpson',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
        ];

        \API\models\User::insert($data);
    }
}
