<?php

namespace App\Http\Requests;


class StoreCommentRequest extends FormRequestApi
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return request()->user()->tokenCan('create-comment');
        
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'comment' => 'required',
            'news_id' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'comment.required' => 'Comment tidak boleh kosong',
            'news_id.required' => 'News Id tidak boleh kosong',
        ];
    }
}
