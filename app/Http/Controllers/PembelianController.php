<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\SimpanPembelianRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Laravel\Prompts\Table;
use Yajra\DataTables\Facades\DataTables;

class PembelianController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Pembelian Obat'
        ];
        return view('pembelian.index')->with($data);
    }

    public function load(Request $request)
    {
        $data = DB::table('pembelian as a')
            ->leftJoin('master_sediaanobat as b', 'a.idSediaan', '=', 'b.id')
            ->leftJoin('master_jenisobat as c', 'a.idJenis', '=', 'c.id')
            ->leftJoin('master_kategoriobat as d', 'a.idKategori', '=', 'd.id')
            ->leftJoin('master_distributor as e', 'a.idDistributor', '=', 'e.id')
            ->leftJoin('master_obat as f', 'a.idObat', '=', 'f.id')
            ->leftJoin('master_satuanobat as g', 'a.idSatuan', '=', 'g.id')
            ->selectRaw('a.*,b.nama as sediaan,c.nama as jenis, d.nama as kategori, e.nama as distributor, f.nama as namaObat, g.nama as satuan')
            ->get();

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('aksi', function ($row) {
                $btn = '<a onclick="edit(\'' . $row->id . '\')" class="btn btn-sm btn-warning" style="margin-right:4px"><i class="fa-solid fa-pen-to-square"></i></a>';
                $btn .= '<a onclick="hapus(\'' . $row->id . '\')" class="btn btn-sm btn-danger"><i class="fa-solid fa-trash"></i></a>';
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function getData(Request $request)
    {
        $term = trim($request->q);
        $formatted_tags = [];
        $query = DB::table('pembelian')
            ->select('id', 'nama');

        // Search by term if provided
        if (!empty($term)) {
            $query->where(function ($query) use ($term) {
                $query->where('id', 'like', "%$term%")
                    ->orWhere('nama', 'like', "%$term%");
            });
        }

        $tags = $query->get();
        foreach ($tags as $tag) {
            $formatted_tags[] = [
                'id' => $tag->id,
                'nama' => $tag->nama,
            ];
        }

        return response()->json($formatted_tags);
    }

    public function save(SimpanPembelianRequest $request)
    {
        $validated = $request->validated();
        DB::beginTransaction();
        try {
            // simpan
            DB::table('pembelian')
                ->insert([
                    'noOrder'           => $validated['noOrder'],
                    'tanggal'           => $validated['tanggalOrder'],
                    'noFaktur'          => $request->noFaktur,
                    'tanggalFaktur'     => $request->tanggalFaktur,
                    'idObat'            => $validated['obat'],
                    'tanggalExpired'    => $validated['tanggalExpired'],
                    'idSediaan'         => $validated['sediaan'],
                    'idJenis'           => $validated['jenis'],
                    'idKategori'        => $validated['kategori'],
                    'idDistributor'     => $validated['distributor'],
                    'idGudang'          => $validated['gudang'],
                    'hna'               => $validated['nilai'],
                    'ppn'               => $validated['nilaippn'],
                    'markup'            => $validated['markup'],
                    'jumlah'            => $validated['jumlah'],
                    'idSatuan'          => $validated['satuan'],
                    'jumlahperstrip'    => $validated['jumlahperstrip'],
                    'idSatuan2'          => $validated['satuan2'],
                    'hja'               => $validated['hja'],
                    'hjasatuan'         => $validated['hjasatuan'],
                    'hjabulat'          => $validated['hjabulat'],
                    'hjasatuanbulat'    => $validated['hjasatuanbulat'],
                    'created_date'      => Carbon::now(),
                    'created_username'  => Auth::user()->name,
                ]);

            DB::commit();
            return response()->json([
                'status' => true,
                'message' => 'Data berhasil ditambahkan!'
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'errors' => ['Data tidak berhasil ditambahkan!'],
                'e' => $th->getMessage()
            ], 500);
        }
    }

    public function dataEdit(Request $request)
    {
        $id = $request->id;
        $data = DB::table('pembelian')
            ->where(['id' => $id])
            ->first();
        $dataObat = DB::table('master_obat')
            ->where(['id' => $data->idObat])
            ->first();

        $dataSediaan = DB::table('master_sediaanobat')
            ->where(['id' => $data->idSediaan])
            ->first();
        $dataJenis = DB::table('master_jenisobat')
            ->where(['id' => $data->idJenis])
            ->first();
        $dataKategori = DB::table('master_kategoriobat')
            ->where(['id' => $data->idKategori])
            ->first();
        $dataDistributor = DB::table('master_distributor')
            ->where(['id' => $data->idDistributor])
            ->first();
        $dataSatuan = DB::table('master_satuanobat')
            ->where(['id' => $data->idSatuan])
            ->first();
        $dataSatuan2 = DB::table('master_satuanobat')
            ->where(['id' => $data->idSatuan2])
            ->first();
        $dataGudang = DB::table('master_gudang')
            ->where(['id' => $data->idGudang])
            ->first();

        return response()->json([
            'data'              => $data,
            'dataObat'          => $dataObat,
            'dataGudang'        => $dataGudang,
            'dataSediaan'       => $dataSediaan,
            'dataJenis'         => $dataJenis,
            'dataKategori'      => $dataKategori,
            'dataDistributor'   => $dataDistributor,
            'dataSatuan'       => $dataSatuan,
            'dataSatuan2'       => $dataSatuan2,
        ]);
    }

    public function update(SimpanPembelianRequest $request)
    {
        $validated = $request->validated();

        DB::beginTransaction();
        try {

                DB::table('pembelian')
                ->where('id', $request->id)
                ->update([
                    'noOrder'           => $validated['noOrder'],
                    'tanggal'           => $validated['tanggalOrder'],
                    'noFaktur'          => $request->noFaktur,
                    'tanggalFaktur'     => $request->tanggalFaktur,
                    'idObat'            => $validated['obat'],
                    'tanggalExpired'    => $validated['tanggalExpired'],
                    'idSediaan'         => $validated['sediaan'],
                    'idJenis'           => $validated['jenis'],
                    'idKategori'        => $validated['kategori'],
                    'idDistributor'     => $validated['distributor'],
                    'idGudang'          => $validated['gudang'],
                    'hna'               => $validated['nilai'],
                    'ppn'               => $validated['nilaippn'],
                    'markup'            => $validated['markup'],
                    'jumlah'            => $validated['jumlah'],
                    'idSatuan'          => $validated['satuan'],
                    'jumlahperstrip'    => $validated['jumlahperstrip'],
                    'idSatuan2'          => $validated['satuan2'],
                    'hja'               => $validated['hja'],
                    'hjasatuan'         => $validated['hjasatuan'],
                    'hjabulat'          => $validated['hjabulat'],
                    'hjasatuanbulat'    => $validated['hjasatuanbulat'],
                    'created_date'      => Carbon::now(),
                    'created_username'  => Auth::user()->name,
                ]);
            DB::commit();
            return response()->json([
                'message' => 'Data berhasil diperbaharui!'
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'errors' => ['Data tidak berhasil diperbaharui!'],
                'e' => $th->getMessage()
            ], 500);
        }
    }

    public function delete(Request $request)
    {
        DB::beginTransaction();
        try {

            DB::table('pembelian')->where(['id' => $request->id])->delete();
            DB::commit();
            return response()->json([
                'message' => 'Data berhasil dihapus!'
            ], 200);
        }catch (\Throwable $th) {
            return response()->json([
                'errors' => ['Data tidak berhasil dihapus!'],
                'e' => $th->getMessage()
            ], 500);
        }

    }
}
