<?php

use Illuminate\Http\Request;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\RegisterToEventController;
use Illuminate\Support\Facades\Route;
use App\Http\Resources\UserResource;
use App\Http\Resources\CalendarEventCollection;
use App\Http\Resources\CalendarEventResource;
use App\Http\Resources\UserCollection;
use App\Models\CalendarEvent;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

Route::post('auth/login', [AuthController::class, 'login']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/user/profile', function (Request $request) {
        return new UserResource($request->user());
    });


    Route::get('/user/events', function (Request $request) {
        return new CalendarEventCollection(CalendarEvent::whereHas('attendees', function (Builder $query) use($request){
                        $query->where('user_id', $request->user()->id);
                    })->paginate());
    });


    Route::get('/events', function (Request $request) {
        return new CalendarEventCollection(CalendarEvent::paginate());
    });


    Route::get('/events/{calendarEvent}', function (Request $request, CalendarEvent $calendarEvent) {
        return new CalendarEventResource($calendarEvent);
    });


    Route::get('/events/{calendarEvent}/attendees', function (Request $request, CalendarEvent $calendarEvent) {
        return new UserCollection(User::whereHas('attendees', function (Builder $query) use($calendarEvent){
                            $query->where('calendar_event_id', $calendarEvent->id);
                        })->get());
    });

    Route::post('/events/{calendarEvent}/register', [RegisterToEventController::class, 'register']);
    Route::delete('/events/{calendarEvent}/unregister', [RegisterToEventController::class, 'unregister']);
    Route::post('auth/logout', [AuthController::class, 'logout']);
});
