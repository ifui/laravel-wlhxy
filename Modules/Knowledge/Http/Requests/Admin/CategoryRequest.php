<?php

namespace Modules\Knowledge\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Request;
use Illuminate\Validation\Rule;

class CategoryRequest extends FormRequest
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
            case 'POST':
                $rules = [
                    'name' => 'required|unique:knowledge_categories|max:20',
                    'order' => 'integer',
                    'status' => 'boolean',
                    'parent_id' => 'integer|exists:knowledge_categories,id',
                ];
                break;

            case 'PUT':
                $id = Request::route('category');
                $rules = [
                    'name' => [Rule::unique('knowledge_categories')->ignore($id), 'max:20'],
                    'order' => 'integer',
                    'status' => 'boolean',
                    'parent_id' => 'integer|exists:knowledge_categories,id',
                ];
                break;

            default:
                return [];
                break;
        }
        return $rules;
    }
}
