<?php

namespace App\Enums;

enum CalendarEventStatusEnum: string
{
    case DRAFT = 'draft';
    case PUBLISHED = 'published';
    case CANCELLED = 'cancelled';
    case COMPLETED = 'completed';

    public function description(): string
    {
        return match($this) 
        {
            self::DRAFT => 'Draft',
            self::PUBLISHED => 'Published',
            self::CANCELLED => 'Cancelled',
            self::COMPLETED => 'Completed',
        };
    }
}