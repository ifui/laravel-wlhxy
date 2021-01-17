<?php

namespace Modules\Classes\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Request;
use Illuminate\Validation\Rule;
use Modules\Classes\Entities\Models\ClassesChapter;

class ChapterRequest extends FormRequest
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
                    'classes_course_id' => 'required|integer|exists:classes_courses,id',
                    'title' => 'required|unique:classes_chapters|max:255',
                    'description' => 'max:255',
                    'price' => 'numeric|min:0',
                    'time' => 'integer',
                    'order' => 'integer',
                    'status' => 'boolean',
                ];
                break;

            case 'PUT':
                $id = Request::route('chapter');
                $rules = [
                    'title' => [Rule::unique(ClassesChapter::class)->ignore($id), 'max:255'],
                    'classes_course_id' => 'integer|exists:classes_chapters,id',
                    'description' => 'max:255',
                    'price' => 'numeric|min:0',
                    'time' => 'integer',
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
