<?php

namespace App\Http\Requests\Admin\Role;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Request;
use Illuminate\Validation\Rule;

class RoleRequest extends FormRequest
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
        switch (Request::method()) {
            case 'GET':
                $rules = [
                    'id' => 'integer',
                    'name' => 'max:20',
                    'guard_name' => 'max:20',
                    'comment' => 'max:200',
                ];
                break;

            case 'POST':
                $rules = [
                    'name' => 'required|unique:roles|max:20',
                    'guard_name' => 'required',
                    'comment' => 'max:200',
                    'permissions' => 'array',
                    'permissions.*' => 'integer|exists:permissions,id|distinct',
                ];
                break;

            case 'PUT':
                $id = Request::route()->parameters['permission'];
                $rules = [
                    'name' => [Rule::unique('roles')->ignore($id), 'max:20'],
                    'comment' => 'max:200',
                    'permissions' => 'array',
                    'permissions.*' => 'integer|exists:permissions,id|distinct',
                ];
                break;

            default:
                break;
        }
        return $rules;
    }
}
