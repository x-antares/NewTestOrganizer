<?php

namespace Database\Factories;

use App\Models\User;
use App\Traits\FakeDate;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReminderFactory extends Factory
{
    use FakeDate;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $dateInterval = $this->generateFakeTime($this->faker, 'reminder');

        return [
            'user_id' => User::select('id')->inRandomOrder()->first(),
            'reminder_name' => $this->faker->word(5),
            'color' => $this->faker->hexColor(),
            'date' => $dateInterval['date'],
        ];
    }
}
