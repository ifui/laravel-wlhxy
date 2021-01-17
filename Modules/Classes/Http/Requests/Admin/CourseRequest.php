<?php

namespace Modules\Classes\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Request;
use Illuminate\Validation\Rule;
use Modules\Classes\Entities\Models\ClassesCourse;

class CourseRequest extends FormRequest
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
                    'classes_grade_id' => 'required|integer|exists:classes_grades,id',
                    'title' => 'required|unique:classes_courses|max:255',
                    'description' => 'max:255',
                    'content' => 'max:65535',
                    'price' => 'numeric|min:0',
                    'order' => 'integer',
                    'status' => 'boolean',
                ];
                break;

            case 'PUT':
                $id = Request::route('course');
                $rules = [
                    'title' => [Rule::unique(ClassesCourse::class)->ignore($id), 'max:255'],
                    'classes_grade_id' => 'integer|exists:classes_grades,id',
                    'description' => 'max:255',
                    'content' => 'max:65535',
                    'price' => 'numeric|min:0',
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
