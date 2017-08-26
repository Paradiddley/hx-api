<?php

use Illuminate\Database\Capsule\Manager as Capsule;

class UserSeed
{
    public function run()
    {
        Capsule::table('user')->truncate();

        $data = [
            [
                'email' => 'homer@simpsons.com',
                'forename' => 'Homer',
                'surname' => 'Simpson'
            ],
            [
                'email' => 'marge@simpsons.com',
                'forename' => 'Marge',
                'surname' => 'Simpson'
            ],
            [
                'email' => 'bart@simpsons.com',
                'forename' => 'Bart',
                'surname' => 'Simpson'
            ],
            [
                'email' => 'lisa@simpsons.com',
                'forename' => 'Lisa',
                'surname' => 'Simpson'
            ],
            [
                'email' => 'maggie@simpsons.com',
                'forename' => 'Maggie',
                'surname' => 'Simpson'
            ],
        ];

        \API\models\User::insert($data);
    }
}
