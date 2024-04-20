<?php

namespace App\Http\Requests;

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
            'firstname' => 'required|max:100',
            'lastname' => 'max:100',
            'username' => 'unique:employees|max:100',
            'email' => 'unique:employees|max:100',
            'phone' => 'digits:10',
            'address' => 'max:100'
        ];
    }

    public function messages()
    {
        return [
            'firstname.max' => ['Too many characters', 'จำนวนตัวอักษรมากเกินไป'],
            'lastname.max' => '*',
            'username.max' => '*',
            'email.max' => '*',
            'address.max' => '*',
            'username.unique' => ['This username is already registered', 'ชื่อผู้ใช้นี้ถูกลงทะเบียนแล้ว'],
            'email.unique' => ['This email is already registered', 'อีเมลนี้ถูกลงทะเบียนแล้ว'],
            'digits.digits' => ['Only 10 numbers', 'ตัวเลข 10 ตัวเท่านั้น'],
        ];
    }
}
