<?php

namespace App\Http\Requests\Book;

use Illuminate\Foundation\Http\FormRequest;

class BookStoreRequest extends FormRequest
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
            'book' => 'required|array|min:1',
            'book.*' => [
                'nullable',
                'file',
                "extensions:fb2,epub,pdf",
                'mimetypes:text/xml,application/epub-zip,application/zip,application/epub+zip,application/epub,epub,fb2,application/pdf',
                'min:1',
                "max:10000",
            ],
            'title' => [
                'nullable',
                'string',
                'min:1',
                'max:255',
            ],
            'authors' => 'required|array|min:1',
            'authors.*' => [
                'nullable',
                'string',
                'min:1',
                'max:255',
            ],
            'description' => [
                'nullable',
                'string',
                'min:1',
                'max:2048',
            ],
            'genres' => [
                'nullable'
            ],
            'year' => [
                'nullable',
                'integer',
                'min:0',
                'max:2100',
            ],
            'cover' => [
                'nullable',
                'file',
                'mimes:png,jpg,jpeg,webp',
                'min:1',
                "max:10000",
            ],
            'tags' => [
                'nullable',
                'array',
            ],
            'tags.*' => [
                'string',
                'min:1',
                'max:32',
            ]
        ];
    }
}
