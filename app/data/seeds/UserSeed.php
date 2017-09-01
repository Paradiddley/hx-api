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
                'email' => 'hans@thesimpsons.com',
                'forename' => 'Hans',
                'surname' => 'Moleman',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'email' => 'barney@simpsons.com',
                'forename' => 'Barney',
                'surname' => 'Gumble',
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
                'email' => 'homer@simpsons.com',
                'forename' => 'Homer',
                'surname' => 'Simpson',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'email' => 'edna@simpsons.com',
                'forename' => 'Edna',
                'surname' => 'Krabappel',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
        ];

        \API\models\User::insert($data);
    }
}
