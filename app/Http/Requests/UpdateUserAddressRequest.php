<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAddressRequest extends FormRequest
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
            'address' => 'required|max:100|min:1',
            'region' => 'required',
            'province' => 'required',
            'district' => 'required',
            'sub_district' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'address.required' => ['Please, Enter address data.', 'กรุณากรอกข้อมูลที่อยู่'],
            'region.required' => ['Please, Select region.', 'กรุณาเลือกภูมิภาค'],
            'province.required' => ['Please, Select province.', 'กรุณาเลือกจังหวัด']
        ];
    }
}
