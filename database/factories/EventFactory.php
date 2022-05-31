<?php

namespace Database\Factories;

use App\Models\Event;
use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    protected $model = Event::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $start_date = CarbonImmutable::instance($this->faker->dateTimeBetween('-1 months', '+1 months'));

        return [
            'id'        => $this->faker->uuid,
            'name'      => $this->faker->name,
            'slug'      => $this->faker->unique()->slug,
            'startAt'   => $start_date,
            'endAt'     => $start_date->addDays(random_int(0, 14)),
            'createdAt' => now()->toDateTimeString(),
            'updatedAt' => now()->toDateTimeString(),
        ];
    }
}
