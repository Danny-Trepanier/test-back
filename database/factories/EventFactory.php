<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $date = fake()->dateTimeBetween('-1 week', '+1 week');
        $time = fake()->time();
        return [
            'title'       => fake()->sentence(),
            'slug'        => fake()->slug(),
            'description' => fake()->paragraph(),
            'start_date'  => $date,
            'end_date'    => Carbon::create($date)->addDays(rand(0, 2)),
            'start_time'  => Carbon::create($time)->format('h:00'),
            'end_time'    => Carbon::create($time)->addHours(rand(0, 2))->format('h:00'),
            'quantity'    => fake()->numberBetween(0, 5),
            'price'       => fake()->randomFloat(2, 0, 100),
        ];
    }
}
