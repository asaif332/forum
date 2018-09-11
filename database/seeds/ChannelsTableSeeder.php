<?php

use Illuminate\Database\Seeder;
use App\Channel;

class ChannelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Channel :: create([
            'title' => 'laravel',
            'slug' => str_slug('laravel'),
        ]);
        Channel :: create([
            'title' => 'wordpress',
            'slug' => str_slug('wordpress'),
        ]);
        Channel :: create([
            'title' => 'github',
            'slug' => str_slug('github'),
        ]);
        Channel :: create([
            'title' => 'django',
            'slug' => str_slug('django'),
        ]);
        Channel :: create([
            'title' => 'symphony',
            'slug' => str_slug('symphony'),
        ]);
        Channel :: create([
            'title' => 'web development',
            'slug' => str_slug('web development'),
        ]);
    }
}
