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
        $maxFileSize = env('MAX_BOOK_SIZE');

        return [
            // Allow octet-stream and epub, but check the file extension
            'book' => [
                'nullable',
                'required',
                'file',
                "extensions:fb2,epub,pdf",
                'mimetypes:text/xml,application/epub-zip,application/zip,application/epub+zip,application/epub,epub,fb2,application/pdf',
                "max:$maxFileSize",
            ],
            'title' => [
                'nullable',
                'string',
                'max:255',
            ],
            'author' => [
                'nullable',
                'string',
                'max:255',
            ],
            'description' => [
                'nullable',
                'string',
                'max:2048',
            ]
        ];
    }
}
