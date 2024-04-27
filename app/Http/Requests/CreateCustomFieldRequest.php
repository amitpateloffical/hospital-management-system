<?php

namespace App\Http\Requests;

use App\Models\CustomField;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateCustomFieldRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $rules = CustomField::$rules;
        $fieldId = $this->route('custom_field');

        $rules['field_name'] = [
            'required',
            Rule::unique('custom_fields')
                ->where('module_name', $this->module_name)
                ->ignore($fieldId),
        ];
        return $rules;
    }

    public function messages(): array
    {
        return [
            // 'field_name.unique' => 'Field name must be uinque',
        ];
    }
}
