<?php

namespace App\Http\Requests\Users;
use Auth;
use Illuminate\Foundation\Http\FormRequest;

class UpdateprofileRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        $user = Auth::user();
        return [
            'givenname' => ['required', 'string', 'max:255'],
            'name' => ['required', 'string', 'max:255'],
            'email' => 'required|email|unique:users,email,'.$user->id,
            'department' => ['present', 'max:255'],
            'role_request' => ['required','string','max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ];
    }
}
