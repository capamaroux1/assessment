<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUserRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {        
        $rules = [
            'first_name' => ['required', 'string', 'max:191'],     
            'last_name' => ['required', 'string', 'max:191'],     
            'is_admin' => ['present', 'boolean'],     
        ];

        if ($this->isMethod('put')) {
            $rules['email'] = ['required','string', 'max:191', Rule::unique('users')->ignore($this->route('user')->id)];

            if ($this->has('password')) {
                 $rules['password'] = 'required|string|min:8';
            }
        } else {
            $rules['password'] = 'required|string|min:8';
            $rules['email'] = ['required','string', 'max:191', Rule::unique('users')];           
        }

        return $rules;
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {       
        $this->merge([
            'is_admin' => $this->is_admin === 'true',
        ]);
    }      
}
