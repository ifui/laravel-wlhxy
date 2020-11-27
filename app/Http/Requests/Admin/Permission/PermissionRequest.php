<?php

namespace App\Http\Requests\Admin\Permission;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Request;
use Illuminate\Validation\Rule;

class PermissionRequest extends FormRequest
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
                    'name' => 'required|unique:permissions|max:20',
                    'guard_name' => 'required|max:20',
                    'comment' => 'max:200',
                    'roles' => 'array',
                    'roles.*' => 'integer|exists:roles,id|distinct',
                ];
                break;

            case 'PUT':
                $id = Request::route('permission');
                $rules = [
                    'name' => [Rule::unique('permissions')->ignore($id), 'max:20'],
                    'comment' => 'max:200',
                    'roles' => 'array',
                    'roles.*' => 'integer|exists:roles,id|distinct',
                ];
                break;
        }
        return $rules;
    }
}
