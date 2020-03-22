<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Answer;
use App\Question;
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

$factory->define(Question::class, function (Faker $faker) {
    return [
        'question'  => substr($faker->sentences(rand(1, 3), true), 0, -1) . '?',
        'rank'      => rand(1, 100),
    ];
});

$factory->define(Answer::class, function (Faker $faker) {
    $question = Question::inRandomOrder()->first();
    if (! $question) {
        $question = factory(Question::class)->create();
    }

    return [
        'question_id' => $question->id,
        'answer'      => $faker->sentences(rand(1, 3), true),
        'tags'        => implode(', ', $faker->words(rand(1, 5))),
    ];
});
