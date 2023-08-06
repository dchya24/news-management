<?php

namespace App\Http\Requests\News;

use App\Http\Requests\FormRequestApi;

class UpdateNewsRequest extends FormRequestApi
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return request()->user()->tokenCan('update-news');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required',
            'content' => 'required',
            'image' => 'image|max:5000'
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Title tidak boleh kosong',
            'content.required' => 'Content tidak boleh kosong',
            'image.image' => 'Image harus berjenis gambar',
            'image.max' => 'Image tidak boleh lebih dari :max'
        ];
    }
}
