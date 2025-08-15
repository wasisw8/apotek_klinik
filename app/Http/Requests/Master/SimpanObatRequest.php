<?php

namespace App\Http\Requests\Master;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SimpanObatRequest extends FormRequest
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
            'nama'          => 'required|string',
            'distributor'   => 'required|string',
            'jenis'         => 'required|string',
            'kategori'      => 'required|string',
            'sediaan'        => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'nama.required' => 'Nama Obat harus diisi!',
            'distributor'   => 'Nama distributor harus diisi!',
            'jenis'         => 'Nama jenis harus diisi!',
            'kategori'      => 'Nama kategori harus diisi!',
            'sediaan'        => 'Nama Sediaan harus diisi!',
        ];
    }
}
