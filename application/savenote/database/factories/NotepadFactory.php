<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Notepad;
use Illuminate\Support\Facades\Hash;
use Faker\Generator as Faker;

$factory->define(Notepad::class, function (Faker $faker) {
    return [
        'url' => 'dinhlongit',
        'type' => 2,
        'password' => Hash::make('123456')
    ];
});
