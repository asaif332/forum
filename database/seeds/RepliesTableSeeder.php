<?php

use Illuminate\Database\Seeder;
use App\Reply;

class RepliesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Reply :: create([
            'content' => ' this is the reply',
            'user_id' => 1,
            'discussion_id' => 1,
        ]);

        Reply :: create([
            'content' => ' this is the reply',
            'user_id' => 1,
            'discussion_id' => 2,
        ]);

        Reply :: create([
            'content' => ' this is the reply',
            'user_id' => 2,
            'discussion_id' => 1,
        ]);

        Reply :: create([
            'content' => ' this is the reply',
            'user_id' => 2,
            'discussion_id' => 2,
        ]);
    }
}
