<?php

namespace App\Http\Controllers;

use App\Http\Requests\EventRequest;
use App\Http\Resources\EventResource;
use App\Jobs\SendEndEmailJob;
use App\Jobs\SendStartEmailJob;
use App\Models\Event;
use Illuminate\Support\Carbon;
use Symfony\Component\HttpFoundation\Response;

class EventController extends Controller
{
    public function index()
    {
        return EventResource::collection(Event::all());
    }

    public function store(EventRequest $request)
    {
        $data = $request->only(['event_name', 'color', 'start_date', 'end_date']);
        $event = Event::create($data);
        $this->sendEmails($event);

        return response()->json([
            'date' => new EventResource($event),
            'message' => 'Event added successfully!!',
            'status' => Response::HTTP_CREATED
        ]);
    }

    public function show(Event $event)
    {
        return response($event, Response::HTTP_OK);
    }

    public function update(EventRequest $request, Event $event)
    {
        $data = $request->only(['event_name', 'color', 'start_date', 'end_date']);
        $event->update($data);
        $event->info->update(['status' => $request->get('status')]);

        return response()->json([
            'data' => new EventResource($event),
            'message' => 'Event updated successfully!!',
            'status' => Response::HTTP_ACCEPTED
        ]);
    }

    public function destroy(Event $event)
    {
        $event->delete();

        return response('Event deleted!!', Response::HTTP_NO_CONTENT);
    }

    public function sendEmails($event)
    {
        $startDate = Carbon::parse($event->start_date);
        $endDate = Carbon::parse($event->end_date);

        dispatch(new SendStartEmailJob(['user' => auth()->user(), 'event' => $event]))->delay($startDate);
        dispatch(new SendEndEmailJob(['user' => auth()->user(), 'event' => $event]))->delay($endDate);
    }
}
