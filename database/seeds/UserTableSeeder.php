<?php

use App\User;
use Illuminate\Database\Seeder;

/**
 * Created by PhpStorm.
 * User: TheHamsterOfGod
 * Date: 3/25/2015
 * Time: 9:54 PM
 */

class UserTableSeeder extends Seeder {

    public function run()
    {
        DB::table('users')->delete();

        $users = [
            [
                'name' => 'foo bar',
                'email' => 'foo@bar.com',
                'password' => bcrypt('foobar'),
            ],
            [
                'name' => 'alpha',
                'email' => 'alpha@alpha.com',
                'password' => bcrypt('alpha'),
            ],
            [
                'name' => 'bravo',
                'email' => 'bravo@bravo.com',
                'password' => bcrypt('bravo'),
            ],
            [
                'name' => 'charlie',
                'email' => 'charlie@charlie.com',
                'password' => bcrypt('charlie'),
            ]
        ];

        foreach ($users as $user)
        {
            User::create($user);
        }

        $this->command->info('Users table seeded!');
    }

}