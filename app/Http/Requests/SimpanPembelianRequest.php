<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SimpanPembelianRequest extends FormRequest
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
            'noOrder'           => 'required|string',
            'tanggalOrder'      => 'required|date',
            'obat'              => 'required|string',
            'tanggalExpired'    => 'required|date',
            'sediaan'           => 'required|string',
            'jenis'             => 'required|string',
            'kategori'          => 'required|string',
            'distributor'       => 'required|string',
            'gudang'            => 'required|string',
            'nilai'             => 'required|string',
            'nilaippn'          => 'required|string',
            'markup'            => 'required|string',
            'jumlah'            => 'required|string',
            'satuan'           => 'required|string',
            'jumlahperstrip'    => 'required|string',
            'satuan2'           => 'required|string',
            'hja'               => 'required|string',
            'hjasatuan'         => 'required|string',
            'hjabulat'          => 'required|string',
            'hjasatuanbulat'    => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'noOrder.required'          => 'Nomor Order harus diisi!',
            'tanggalOrder.required'     => 'Tanggal Order harus diisi!',
            'obat.required'             => 'Obat harus diisi!',
            'tanggalExpired.required'   => 'Tanggal Expired harus diisi!',
            'sediaan.required'          => 'Sediaan harus diisi!',
            'jenis.required'            => 'Jenis harus diisi!',
            'kategori.required'         => 'Kategori harus diisi!',
            'distributor.required'      => 'Distributor harus diisi!',
            'gudang.required'           => 'Gudang harus diisi!',
            'nilai.required'            => 'Nilai harus diisi!',
            'nilaippn.required'         => 'Nilai ppn harus diisi!',
            'markup.required'           => 'Markup harus diisi!',
            'jumlah.required'           => 'Jumlah harus diisi!',
            'satuan.required'           => 'Satuan harus diisi!',
            'jumlahperstrip.required'   => 'Jumlah per strip harus diisi!',
            'satuan2.required'          => 'Satuan Rinci harus diisi!',
            'hja.required'              => 'HJA harus diisi!',
            'hjasatuan.required'        => 'HJA satuan harus diisi!',
            'hjabulat.required'         => 'HJA pembulatan harus diisi!',
            'hjasatuanbulat.required'   => 'HJA satuan pembulatan harus diisi!',
        ];
    }
}
