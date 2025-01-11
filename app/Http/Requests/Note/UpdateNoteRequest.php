<?php

namespace App\Http\Requests\Note;

use Illuminate\Foundation\Http\FormRequest;

class UpdateNoteRequest extends FormRequest
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
        return [
            'title'      => 'sometimes|string|min:1|max:255',
            'visibility' => 'sometimes|in:shared,private',
            'type'       => 'sometimes|in:text,pdf',
            'text_body'  => 'nullable|string',
            'pdf_path' => 'nullable|file|mimes:pdf'
        ];
    }
}
