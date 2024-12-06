<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Enums\CalendarEventLocationEnum;
use App\Enums\CalendarEventStatusEnum;
use App\Enums\CalendarEventTypeEnum;

class StoreCalendarEventRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string','max:50'],
            'description' => ['required', 'string','max:50'],
            'capacity' => ['required', 'integer','min:0'],
            'start_date' => ['required', 'date_format:Y-m-d H:i'],
            'location' => ['required', Rule::in( array_column(CalendarEventLocationEnum::cases(), 'value') )],
            'status' => ['required', Rule::in( array_column(CalendarEventStatusEnum::cases(), 'value') )],
            'type' => ['required', Rule::in( array_column(CalendarEventTypeEnum::cases(), 'value') )],
        ];
    }
}
