<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CalendarEvent;
use App\Models\Attendee;
use App\Events\UserRegisteredToEvent;
use App\Http\Requests\RegisterToEventRequest;
use App\Http\Requests\UnregisterToEventRequest;

class RegisterToEventController extends Controller
{
    /**
     * Register user to event
     */
    public function register(RegisterToEventRequest $request, CalendarEvent $calendarEvent)
    {
        $user = $request->user();   
        $attendee = new Attendee;     
        $attendee->user()->associate($user);   
        $attendee->calendarEvent()->associate($calendarEvent);   
        $attendee->save();

        UserRegisteredToEvent::dispatch( $attendee );

        return response()->json([
            'message' => 'You are succesfully register to this event!'
        ], 200);       
    }


    /**
     * Unregister user to event
     */
    public function unregister(UnregisterToEventRequest $request, CalendarEvent $calendarEvent)
    {
        $user = $request->user();  
        $calendarEvent->attendees()->where('user_id', $user->id)->delete();

        return response()->json([
            'message' => 'You are succesfully unregister from this event!'
        ], 200);       
    }
}
