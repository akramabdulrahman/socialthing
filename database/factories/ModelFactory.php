<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Models\Social\Post::class, function (Faker\Generator $faker) {

    return [
        'content' => $faker->paragraph,
        'user_id' => 1,
    ];
});

$factory->define(App\Models\Social\Comment::class, function (Faker\Generator $faker) {

    return [
        'content' => $faker->paragraph,
        'user_id' => 1,
    ];
});

$factory->define(App\Models\Media::class, function (Faker\Generator $faker) {

    return [
        'url' => $faker->url,
        'post_id'=>$faker->numberBetween(1,6)
    ];
});

$factory->defineAs(App\Models\Media::class, 'image', function (Faker\Generator $faker) use ($factory) {
    $media = $factory->raw(App\Models\Media::class);

    return array_merge($media, [
        'media_type'=>'image'//$faker->randomElement(array('image','video'))
    ]);
});

$factory->defineAs(App\Models\Media::class, 'video', function (Faker\Generator $faker) use ($factory) {
    $media = $factory->raw(App\Models\Media::class);

    return array_merge($media, [
        'media_type'=>'video'//$faker->randomElement(array('image','video'))
    ]);
});
