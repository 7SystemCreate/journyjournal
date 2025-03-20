<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePost extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|max:2048',
            'date' => 'nullable|date',
            'max_people' => 'nullable|integer|min:1',
            'amount' => 'nullable|integer|min:0',
            'comment' => 'nullable|string|max:255',
        ];
    }
}
