<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enums\CalendarEventLocationEnum;
use App\Enums\CalendarEventTypeEnum;
use App\Enums\CalendarEventStatusEnum;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CalendarEvent extends Model
{
    use SoftDeletes;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'start_date' => 'datetime',
            'capacity' => 'integer',
            'location' => CalendarEventLocationEnum::class,
            'status' => CalendarEventStatusEnum::class,
            'type' => CalendarEventTypeEnum::class,
        ];
    }

    /**
    * The attributes that aren't mass assignable.
    *
    * @var array<string>|bool
    */
    protected $guarded = [];

    /**
     * Get the attendees for the event.
     */
    public function attendees(): HasMany
    {
        return $this->hasMany(Attendee::class);
    }    
}
