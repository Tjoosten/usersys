<?php

namespace Qumonto\UserSys\Http\Requests;

use App\Http\Requests\Request;
use Qumonto\UserSys\AuthenticationTrait;

class UserLoginRequest extends Request
{
    use AuthenticationTrait;
    
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
        return [
            $this->getUsernameColumnAndField() => 'required|max:255|unique:users',
            $this->getPasswordColumnAndField() => 'required|confirmed|min:6',
        ];
    }
}