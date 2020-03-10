<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Model;
use Faker\Generator as Faker;
use Webpatser\Uuid\Uuid;

$factory->define(App\Music::class, function (Faker $faker) {
    return [
        'album_id' => 2,
        'title' => $faker->text(5),
        'uuid' =>'song'.uniqid(true),
        'artist' => 'Nelson',
        'album' => $faker->text(6),
        'year' => '2019',
        'genre' => $faker->text(7),
        'file_name' => $faker->text(8).'mp3',
        'image_filename' => $faker->text(8).'jpg',
        'image_url' =>storage_path().'\\uploads\\images\\'.$faker->text(8).'jpg'




    ];
});
