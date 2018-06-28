<?php

use Illuminate\Database\Seeder;

class WorkersTableSeeder extends Seeder
{
    /**
     * Create workers
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create('Ru_ru');
        for ($i = 0; $i < 5; $i++) {
            App\Worker::create([
                'pid' => 0,
                'post_id' => 1,
                'name' => $faker->name,
                'salary' => 10000,
                'created_at' => $faker->dateTimeBetween($startDate = '-5 years', $endDate = '-2 years', $timezone = 'UTC'),
                'updated_at' => $faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now', $timezone = 'UTC'),
            ]);
        }
        for ($i = 0; $i < 55; $i++) {
            App\Worker::create([
                'pid' => mt_rand(1, 5),
                'post_id' => 2,
                'name' => $faker->name,
                'salary' => 5000,
                'created_at' => $faker->dateTimeBetween($startDate = '-5 years', $endDate = '-2 years', $timezone = 'UTC'),
                'updated_at' => $faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now', $timezone = 'UTC'),
            ]);
        }

        for($i = 0; $i < 555; $i++) {
            App\Worker::create([
                'pid' => mt_rand(6, 55),
                'post_id' => 3,
                'name' => $faker->name,
                'salary' => 3000,
                'created_at' => $faker->dateTimeBetween($startDate = '-5 years', $endDate = '-2 years', $timezone = 'UTC'),
                'updated_at' => $faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now', $timezone = 'UTC'),
            ]);
        }

        for($i = 0; $i < 5555; $i++) {
            App\Worker::create([
                'pid' => mt_rand(56, 555),
                'post_id' => 4,
                'name' => $faker->name,
                'salary' => 1000,
                'created_at' => $faker->dateTimeBetween($startDate = '-5 years', $endDate = '-2 years', $timezone = 'UTC'),
                'updated_at' => $faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now', $timezone = 'UTC'),
            ]);
        }

        for($i = 0; $i < 44445; $i++) {
            App\Worker::create([
                'pid' => mt_rand(556, 5555),
                'post_id' => 5,
                'name' => $faker->name,
                'salary' => 500,
                'created_at' => $faker->dateTimeBetween($startDate = '-5 years', $endDate = '-2 years', $timezone = 'UTC'),
                'updated_at' => $faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now', $timezone = 'UTC'),
            ]);
        }
    }
}
