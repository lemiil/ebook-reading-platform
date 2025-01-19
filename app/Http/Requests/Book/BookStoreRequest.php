<?php

namespace App\Http\Requests\Book;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class BookStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'book' => 'required|array|min:1|max:3',
            'book.fb2' => [
                'nullable',
                'file',
                'mimes:xml,text/xml,application/zip,fb2',
                'max:10000',
            ],
            'book.epub' => [
                'nullable',
                'file',
                'mimes:application/epub+zip,application/epub,application/epub-zip,epub',
                'max:10000',
            ],
            'book.pdf' => [
                'nullable',
                'file',
                'mimes:application/pdf,pdf',
                'max:10000',
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
                'nullable',
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
                'max:10000',
            ],
            'tags' => [
                'nullable',
                'array',
            ],
            'tags.*' => [
                'string',
                'min:1',
                'max:32',
            ],
        ];
    }

}
