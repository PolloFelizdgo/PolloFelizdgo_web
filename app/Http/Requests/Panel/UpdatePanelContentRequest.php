<?php

namespace App\Http\Requests\Panel;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePanelContentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'payload_json' => ['required', 'string'],
            'change_note' => ['nullable', 'string', 'max:255'],
        ];
    }
}
