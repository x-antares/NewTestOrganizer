<?php


namespace App\Traits;


use Illuminate\Support\Carbon;

trait FakeDate
{
    public function generateFakeTime($faker, $type)
    {
        $arrayTimeFunction = ['addMinutes', 'addHours', 'addDays', 'addYears'];
        $arrayTimeValue = ['month' ,'days', 'hours', 'years'];
        $num1 = rand(0, 3);
        $num2 = rand(0, 3);

        if($type == 'event')
        {
            $timeFunction = $arrayTimeFunction[$num1];

            $startDate = $faker->dateTimeBetween($startDate = 'now', $endDate = "+".$num2." " .$arrayTimeValue[$num2]);
            $endDate = Carbon::createFromFormat('Y-m-d H:i:s', $startDate->format('Y-m-d H:i:s'))->$timeFunction()->$timeFunction();

            $data = [
                'startDate' => $startDate,
                'endDate' => $endDate
            ];
        }else{
            $date = $faker->dateTimeBetween($startDate = 'now', $endDate = "+".$num2." " .$arrayTimeValue[$num2]);

            $data = [
                'date' => $date
            ];
        }



        return $data;
    }
}
