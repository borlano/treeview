<?php

use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Create posts
     *
     * @return void
     */
    public function run()
    {
        $posts = ['Директор', 'Директор филиала', 'Нач.отдела', 'Прораб', 'Рабочий'];
        for($i = 0; $i < 5; $i++) {
            App\Post::create([
                'name' => $posts[$i]
            ]);
        }
    }
}