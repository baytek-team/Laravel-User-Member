<?php

namespace Baytek\Laravel\Users\Members\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MemberRequest extends FormRequest
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
        $id = 0;

        if ($this->route('user')) {
            $id = $this->route('user');
        }
        else if ($this->route('member')) {
            $id = $this->route('member');
        }

        return [
            'email' => 'sometimes|required|email|max:255|unique:users,email,'.$id,
            'meta.first_name' => 'required|max:127',
            'meta.last_name' => 'required|max:127',
        ];
    }
}
