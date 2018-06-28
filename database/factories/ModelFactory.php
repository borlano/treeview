<?php

/**
 * Generate random Worker data
 *
 * @var \Illuminate\Database\Eloquent\Factory $factory
 *
 * @return array
 */
$factory->define(App\Worker::class, function () {

    $faker = Faker\Factory::create('Ru_ru');

    $post_id = mt_rand(2, 5);

    return [
        'post_id' => $post_id,
        'pid' => $post_id - 1,
        'name' => $faker->name,
        'salary' => mt_rand(100, 1000)
    ];
});