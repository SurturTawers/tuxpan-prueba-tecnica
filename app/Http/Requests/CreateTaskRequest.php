<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateTaskRequest extends FormRequest
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
            'title' => 'required|unique:tasks|max:100',
            'description' => 'required|max:255',
            'priority' => 'required|numeric|between:1,100',
            'due_at' => 'required|date|after:today',
            'assigned_users' => 'array:id',
        ];
    }
}
