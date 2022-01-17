<?php

namespace App\Http\Requests\Users;
use Illuminate\Foundation\Http\FormRequest;
use App\Models\User;

class UpdateprofileRequestByAdminPW extends FormRequest
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
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ];
    }
}
