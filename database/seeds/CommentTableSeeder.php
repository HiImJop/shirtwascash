<?php
use Illuminate\Database\Seeder;

/**
 * Created by PhpStorm.
 * User: TheHamsterOfGod
 * Date: 3/26/2015
 * Time: 1:26 AM
 */

class CommentTableSeeder extends Seeder {

    public function run()
    {
        DB::table('comments')->delete();

        $comments = [
            [
                'comment' => 'comment to shirt1 by user1',
                'shirt_id' => 1,
                'user_id' => 1,
            ],
            [
                'comment' => 'comment to shirt1 by user2',
                'shirt_id' => 1,
                'user_id' => 2,
            ],
            [
                'comment' => 'comment to shirt2 by user2',
                'shirt_id' => 2,
                'user_id' => 2,
            ],
            [
                'comment' => 'comment to shirt3 by user3',
                'shirt_id' => 3,
                'user_id' => 3,
            ],
        ];

        foreach ($comments as $comment)
        {
            Comment::create($comment);
        }

        $this->command->info('Comments table seeded!');
    }


}