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

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
    	
        'nombre_usuario' => $faker->userName,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Persona::class, function (Faker\Generator $faker) {
    static $password;

    return [
    	
        'primer_apellido'=>  $faker->name,
        'segundo_apellido'=> $faker->name,
        'cedula' => $faker->randomNumber, 
        'primer_nombre' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'fecha_nacimiento'=>$faker->date($format = 'Y-m-d', $max = 'now'),
        'telefono'=>$faker->phoneNumber,
        'direccion'=>$faker->address, 
    ];
});


