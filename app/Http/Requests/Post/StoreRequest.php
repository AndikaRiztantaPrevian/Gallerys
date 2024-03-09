<?php

namespace App\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'title' => 'required|min:0|max:100',
            'description' => 'required|min:5',
            'album_id' => 'required',
            'image' => 'required|mimes:png,jpg,jpeg'
        ];
    }

    public function message()
    {
        return [
            'title.required' => 'Judul harus diisi',
            'title.min' => 'Judul minimal 5 Kata',
            'title.max' => 'Judul maksimal 100 Kata',
            'description.required' => 'Deskripsi harus diisi',
            'description.min' => 'Judul minimal 5 Kata',
            'album_id.required' => 'Album harus diisi',
            'image.required' => 'Anda belum memasukkan foto!',
            'image.mimes' => 'Format gambar harus PNG, JPG, JPEG',
        ];
    }
}
