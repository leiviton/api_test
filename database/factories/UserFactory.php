<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use TestPax\Models\Councilor;
use TestPax\Models\PoliticalParty;
use TestPax\Models\ListProposition;
use TestPax\Models\ProcessesOrder;
use TestPax\Models\ProcessingState;
use TestPax\Models\CommisionPosition;
use TestPax\Models\TablePosition;
use TestPax\Models\SolicitationItem;
use TestPax\Models\Company;
use TestPax\Models\Solicitation;
use TestPax\Models\TransferRegime;
use TestPax\Models\Phase;
use TestPax\Models\Situation;
use TestPax\Models\PropositionOrigin;
use TestPax\Models\User;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
    ];
});

$factory->define(TestPax\Models\Category::class, function (Faker $faker){
    return [
        'name' =>$faker->word
    ];
});

$factory->define(TestPax\Models\Product::class, function (Faker $faker){
    return [
        'name' =>$faker->word,
        'description' => $faker->sentence,
        'price' => $faker->numberBetween(10,50)
    ];
});
