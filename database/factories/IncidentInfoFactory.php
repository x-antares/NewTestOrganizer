<?php

namespace Database\Factories;

use App\Models\Event;
use App\Models\Reminder;
use Illuminate\Database\Eloquent\Factories\Factory;

class IncidentInfoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $arrayFrequency = ['every year', 'every month', 'every day'];
        $infoable = $this->infoable();
        $incident = $infoable::factory()->create();
        $now = now();

        if(str_contains($infoable, Event::class))
        {
            $frequency = 'one time';
            $incidentEndDate = $incident->end_date;
            $incidentStartDate = $incident->start_date;

            $status = match (true) {
                $now > $incidentEndDate => $infoable::TYPE_DONE,
                $now > $incidentStartDate && $now < $incidentEndDate => $infoable::TYPE_STARTED,
                $now < $incidentStartDate => $infoable::TYPE_FUTURE,
                default => $infoable::TYPE_FUTURE,
            };
        }else{
            $frequency = $arrayFrequency[rand(0, 2)];
            $incidentDate = $incident->date;

            if($now > $incidentDate)
            {
                $status = $infoable::TYPE_DONE;
            }else{
                $status = $infoable::TYPE_FUTURE;
            }
        }

        return [
            'infoable_id' => $incident->id,
            'infoable_type' => $infoable,
            'frequency' => $frequency,
            'status' => $status
        ];
    }

    public function infoable()
    {
        return $this->faker->randomElement([
            Event::class,
            Reminder::class,
        ]);
    }
}
