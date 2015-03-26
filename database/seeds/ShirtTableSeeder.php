<?php
use App\Shirt;
use Illuminate\Database\Seeder;

/**
 * Created by PhpStorm.
 * User: TheHamsterOfGod
 * Date: 3/26/2015
 * Time: 1:09 AM
 */

class ShirtTableSeeder extends Seeder {

    public function run()
    {
        DB::table('shirts')->delete();

        $shirts = [
            [
                'name' => 'shirt1.png',
                'mime' => 'image/png',
                'user_id' => 1,
            ],
            [
                'name' => 'shirt2.png',
                'mime' => 'image/png',
                'user_id' => 1,
            ],
            [
                'name' => 'shirt3.png',
                'mime' => 'image/png',
                'user_id' => 2,
            ],
            [
                'name' => 'shirt4.png',
                'mime' => 'image/png',
                'user_id' => 3,
            ],
        ];

        foreach ($shirts as $shirt)
        {
            Shirt::create($shirt);
        }

        $this->command->info('Shirts table seeded!');
    }


}