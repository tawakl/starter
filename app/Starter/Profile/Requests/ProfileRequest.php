<?php

namespace App\Starter\Profile\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
{


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|regex:/^[\pL\s\d]+$/u|max:191|min:3',
//            'last_name' => 'required|regex:/^[\pL\s\d]+$/u|max:191|min:3',
            'email' => [
                'required', 'email',Rule::unique('users')->where(function ($query) {
                    return $query->where('deleted_at', null);
                })->ignore($this->id),
            ],
            'mobile_number' => [
                'required', 'mobile',Rule::unique('users')->where(function ($query) {
                    return $query->where('deleted_at', null);
                })->ignore($this->id),
            ],
            'password' => 'nullable|min:8|confirmed',
        ];
    }
}
