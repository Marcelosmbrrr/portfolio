<?php

namespace App\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;

class CreatePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function prepareForValidation()
    {
        $this->merge([
            'tags' => explode(',', $this->tags),
            'is_published' => $this->is_published === "1"
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "is_published" => ["required", "boolean"],
            "name" => ["required", "unique:posts,name", "min:3", "max:255"],
            "description" => ["required", "min:30", "max:80"],
            "tags" => ["required", 'array', 'min:1'],
            "category" => ["required"],
            "content" => ["required", "min:30"],
            "image" => ["required", "image", "dimensions:min_height=300, max_height=600, max_width=600"]
        ];
    }
}
