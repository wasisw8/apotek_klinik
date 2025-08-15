<?php

namespace App\Http\Requests\Master;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SimpanSediaanObatRequest extends FormRequest
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
            'nama'     => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'nama.required'         => 'Nama Sediaan Obat harus diisi!',
        ];
    }
}
