<?php

namespace Modules\Classes\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Request;
use Illuminate\Validation\Rule;
use Modules\Classes\Entities\Models\ClassesGrade;

class GradeRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        switch (Request::method()) {
            case 'POST':
                $rules = [
                    'name' => 'required|unique:classes_grades|max:255',
                    'remark' => 'max:255',
                    'color' => 'max:255',
                    'order' => 'integer',
                    'status' => 'boolean',
                ];
                break;

            case 'PUT':
                $id = Request::route('grade');
                $rules = [
                    'name' => [Rule::unique(ClassesGrade::class)->ignore($id), 'max:255'],
                    'remark' => 'max:255',
                    'color' => 'max:255',
                    'order' => 'integer',
                    'status' => 'boolean',
                ];
                break;

            default:
                return [];
                break;
        }
        return $rules;
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
