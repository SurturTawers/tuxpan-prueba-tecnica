<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTaskRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => 'unique:tasks|max:100',
            'description' => 'max:255',
            'priority' => 'numeric|between:1,100',
            'due_at' => 'date|after:today',
            'assigned_users' => 'array:id',
        ];
    }
}
