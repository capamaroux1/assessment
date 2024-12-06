<?php

namespace App\Http\Controllers;

use App\Models\CalendarEvent;
use App\Http\Requests\StoreCalendarEventRequest;
use App\Http\Requests\UpdateCalendarEventRequest;
use Illuminate\View\View;
use App\Enums\CalendarEventLocationEnum;
use App\Enums\CalendarEventStatusEnum;
use App\Enums\CalendarEventTypeEnum;

class CalendarEventController extends Controller
{
    protected $eventLocations = [];

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->eventLocations = CalendarEventLocationEnum::cases();
        $this->eventStatus = CalendarEventStatusEnum::cases();
        $this->eventTypes = CalendarEventTypeEnum::cases();
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('calendar-events.index', [
            'calendar_events' => CalendarEvent::paginate(15)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('calendar-events.create_edit', [
            'calendarEvent' => new CalendarEvent,
            'eventLocations' => $this->eventLocations,
            'eventStatus' => $this->eventStatus,
            'eventTypes' => $this->eventTypes,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCalendarEventRequest $request)
    {
        CalendarEvent::create( $request->validated() );       

        return response()->json([
            'success' => true
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(CalendarEvent $calendarEvent)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CalendarEvent $calendarEvent)
    {
        return view('calendar-events.create_edit', [
            'calendarEvent' => $calendarEvent,
            'eventLocations' => $this->eventLocations,
            'eventStatus' => $this->eventStatus,
            'eventTypes' => $this->eventTypes,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreCalendarEventRequest $request, CalendarEvent $calendarEvent)
    {
        $calendarEvent->fill( $request->validated() )->save();   

        return response()->json([
            'success' => true
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CalendarEvent $calendarEvent)
    {
        $calendarEvent->delete();
        
        return to_route('calendar-events.index'); 
    }
}
