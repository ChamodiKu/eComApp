<?php

namespace App\Http\Requests\Admin\Users;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
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
            'fname' => 'required|min:1|max:255',
            'lname' => 'required|min:1|max:255',
            'email ' => 'required|email|unique:users|min:1|max:255',
            'password' => 'required|string|min:8|max:255',
        ];
    }

    public function messages()
    {
        return [
            'fname.required' => 'First name is required',
            'fname.min' => 'First name is too short',
            'fname.max' => 'First name is too long',

            'lname.required' => 'Last name is required',
            'lname.min' => 'Last name is too short',
            'lname.max' => 'Last name is too long',

            'email.required' => 'Email required',
            'email.email' => 'Email should be a valid email',
            'email.min' => 'Email too short',
            'email.max' => 'Email too long',
            'email.unique' => 'Email already exists',

            'password.required' => 'Password required',
            'password.string' => 'Password should be a string',
            'password.min' => 'Password must be at least 8 characters',
            'password.max' => 'Password too long'
        ];
    }
}
