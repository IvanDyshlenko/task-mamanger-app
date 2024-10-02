<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            "username" => "required|string",
            "email" => "required|string",
            "description" => "required|string",
            "is_done" => "boolean"
        ];

        return match ($this->getMethod()) {
            "POST", "PUT" => $rules,
            "DELETE" => ["id" => "required|uuid|exists:tasks,id"],
            default => [],
        };
    }
}
