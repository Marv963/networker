<?php

namespace App\Http\Requests\Users;
use Illuminate\Foundation\Http\FormRequest;
use App\Models\User;

class UpdateprofileRequestByAdmin extends FormRequest
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
        $id = $this->id;
        $user = User::findOrFail($id);

        return [
            'givenname' => ['required', 'string', 'max:255'],
            'name' => ['required', 'string', 'max:255'],
            'email' => 'required|email|unique:users,email,'.$user->id,
            'department' => ['present', 'max:255'],
            'role' => ['sometimes','string','max:255'],
        ];
    }
}
