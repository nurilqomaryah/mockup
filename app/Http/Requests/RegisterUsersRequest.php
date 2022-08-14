<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterUsersRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'username' => 'required',
            'password' => 'required',
            're-password' => 'required|same:password'
        ];
    }

    public function messages()
    {
        return [
            'username.required' => 'Username tidak boleh kosong',
            'password.required' => 'Password tidak boleh kosong',
            're-password.required' => 'Ulangi Password tidak boleh kosong',
            're-password.same' => 'Password dan Ulangi Password tidak sama'
        ];
    }
}
