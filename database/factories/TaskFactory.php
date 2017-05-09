<?php

$factory->define(App\Task::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'description' => str_random(100),
        'completed' => '0'
    ];
});

?>