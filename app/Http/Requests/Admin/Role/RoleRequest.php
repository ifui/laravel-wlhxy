<?php

namespace App\Http\Requests\Admin\Role;

use Illuminate\Auth\Access\AuthorizationException;
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
        if (auth()->user()->can('Super-Admin')) {
            return true;
        } else {
            throw new AuthorizationException('没有权限');
        }
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
                    'users' => 'array',
                    'users.*' => 'integer|exists:users,id|distinct',
                    'admin_users' => 'array',
                    'admin_users.*' => 'integer|exists:admin_users,id|distinct',
                ];
                break;

            case 'PUT':
                $id = Request::route('roles');
                $rules = [
                    'name' => [Rule::unique('roles')->ignore($id), 'max:20'],
                    'comment' => 'max:200',
                    'permissions' => 'array',
                    'permissions.*' => 'integer|exists:permissions,id|distinct',
                    'users' => 'array',
                    'users.*' => 'integer|exists:users,id|distinct',
                    'admin_users' => 'array',
                    'admin_users.*' => 'integer|exists:admin_users,id|distinct',
                ];
                break;

            default:
                break;
        }
        return $rules;
    }
}
