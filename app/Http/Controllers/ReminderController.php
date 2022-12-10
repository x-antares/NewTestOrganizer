<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReminderRequest;
use App\Http\Resources\ReminderResource;
use App\Jobs\SendStartEmailJob;
use App\Models\Reminder;
use Illuminate\Support\Carbon;
use Symfony\Component\HttpFoundation\Response;

class ReminderController extends Controller
{
    public function index()
    {
        return ReminderResource::collection(Reminder::all());
    }

    public function store(ReminderRequest $request)
    {
        $data = $request->only(['reminder_name', 'color', 'date']);
        $reminder = Reminder::create($data);

        $this->sendEmails($reminder);

        return response()->json([
            'date' => new ReminderResource($reminder),
            'message' => 'Reminder added successfully!!',
            'status' => Response::HTTP_CREATED
        ]);
    }

    public function show(Reminder $reminder)
    {
        return response($reminder, Response::HTTP_OK);
    }

    public function update(ReminderRequest $request, Reminder $reminder)
    {
        $data = $request->only(['reminder_name', 'color', 'date']);
        $reminder->update($data);

        return response()->json([
            'data' => new ReminderResource($reminder),
            'message' => 'Event updated successfully!!',
            'status' => Response::HTTP_ACCEPTED
        ]);
    }

    public function sendEmails($reminder)
    {
        $startDate = Carbon::parse($reminder->date);

        dispatch(new SendStartEmailJob(['user' => auth()->user(), 'event' => $reminder]))->delay($startDate);
    }
}
