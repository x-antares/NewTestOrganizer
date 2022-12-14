<?php

namespace Database\Factories;

use App\Models\User;
use App\Traits\FakeDate;
use Illuminate\Database\Eloquent\Factories\Factory;

class EventFactory extends Factory
{
    use FakeDate;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $dateInterval = $this->generateFakeTime($this->faker, 'event');
        $user = User::select('id')->inRandomOrder()->first();

        return [
            'user_id' => $user->id,
            'event_name' => $this->faker->word(5),
            'color' => $this->faker->hexColor(),
            'start_date' => $dateInterval['startDate'],
            'end_date' => $dateInterval['endDate'],
        ];
    }
}
