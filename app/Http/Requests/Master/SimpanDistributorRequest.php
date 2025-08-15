<?php

namespace App\Http\Requests\Master;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SimpanDistributorRequest extends FormRequest
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
            'alamat'     => 'required|string',
            'nohp'     => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'nama.required'         => 'Nama Distributor harus diisi!',
            'alamat.required'       => 'Alamat Distributor harus diisi!',
            'nohp.required'         => 'Nomor HP Distributor harus diisi!',
        ];
    }
}
