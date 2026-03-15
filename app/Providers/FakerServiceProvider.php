<?php

namespace App\Providers;

use App\Libraries\Faker;
use Faker\Factory;
use Faker\Generator;
use Illuminate\Support\ServiceProvider;

class FakerServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(Generator::class, function () {
            $faker = Factory::create();
            $faker->addProvider(new Faker($faker));

            return $faker;
        });

        $this->app->bind(
            Generator::class . ':' . config('app.faker_locale'),
            Generator::class
        );
    }
}
