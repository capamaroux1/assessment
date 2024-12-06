<?php

namespace App\Enums;

enum CalendarEventLocationEnum: string
{
    case PHYSICAL = 'physical';
    case VIRTUAL = 'virtual';

    public function description(): string
    {
        return match($this) 
        {
            self::PHYSICAL => 'Physical',
            self::VIRTUAL => 'Virtual',
        };
    }
}