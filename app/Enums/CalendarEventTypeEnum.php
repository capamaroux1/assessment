<?php

namespace App\Enums;

enum CalendarEventTypeEnum: string
{
    case WORKSHOP = 'workshop';
    case SOCIAL = 'social';
    case TRAINING = 'training';

    public function description(): string
    {
        return match($this) 
        {
            self::WORKSHOP => 'Workshop',
            self::SOCIAL => 'Social',
            self::TRAINING => 'Training',
        };
    }
}