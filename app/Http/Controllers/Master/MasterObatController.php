<?php
namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Http\Requests\Master\SimpanObatRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Laravel\Prompts\Table;
use Yajra\DataTables\Facades\DataTables;

class MasterObatController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Master Obat'
        ];
        return view('master.obat.index')->with($data);
    }

    public function load(Request $request)
    {
        $data = DB::table('master_obat as a')
            ->leftJoin('master_sediaanobat as b', 'a.idSediaan', '=', 'b.id')
            ->leftJoin('master_jenisobat as c', 'a.idJenis', '=', 'c.id')
            ->leftJoin('master_kategoriobat as d', 'a.idKategori', '=', 'd.id')
            ->leftJoin('master_distributor as e', 'a.idDistributor', '=', 'e.id')
            ->selectRaw('a.*,b.nama as sediaan,c.nama as jenis, d.nama as kategori, e.nama as distributor')
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
        $query = DB::table('master_obat as a')
                ->leftJoin('master_sediaanobat as b', 'a.idSediaan', '=', 'b.id')
                ->leftJoin('master_jenisobat as c', 'a.idJenis', '=', 'c.id')
                ->leftJoin('master_kategoriobat as d', 'a.idKategori', '=', 'd.id')
                ->leftJoin('master_distributor as e', 'a.idDistributor', '=', 'e.id')
                ->selectRaw('a.*,b.nama as sediaan,c.nama as jenis, d.nama as kategori, e.nama as distributor');

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
                'id'            => $tag->id,
                'nama'          => $tag->nama.' | '.$tag->distributor.' | '.$tag->jenis,
                'idDistributor' => $tag->idDistributor,
                'idJenis'       => $tag->idJenis,
                'idKategori'    => $tag->idKategori,
                'idSediaan'      => $tag->idSediaan,
                'distributor'   => $tag->distributor,
                'jenis'         => $tag->jenis,
                'kategori'      => $tag->kategori,
                'sediaan'        => $tag->sediaan,
            ];
        }

        return response()->json($formatted_tags);
    }

    public function save(SimpanObatRequest $request)
    {
        $validated = $request->validated();
        // cek apakah sudah ada Distributor
        $cek = DB::table('master_obat')->where([
                'nama'          => $validated['nama'],
                'idSediaan'      => $validated['sediaan'],
                'idDistributor' => $validated['distributor'],
                'idJenis'       => $validated['jenis'],
                'idKategori'    => $validated['kategori'],
            ])->exists();
        if($cek){
            return response()->json([
                'status' => false,
                'message' => 'Data Sudah ada!'
            ], 200);
        }
        DB::beginTransaction();
        try {
            // simpan
            DB::table('master_obat')
                ->insert([
                    'nama'          => $validated['nama'],
                    'idSediaan'      => $validated['sediaan'],
                    'idDistributor' => $validated['distributor'],
                    'idJenis'       => $validated['jenis'],
                    'idKategori'    => $validated['kategori'],
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
        $data = DB::table('master_obat')
            ->where(['id' => $id])
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

        return response()->json([
            'data'          => $data,
            'dataSediaan'    => $dataSediaan,
            'dataJenis'     => $dataJenis,
            'dataKategori'  => $dataKategori,
            'dataDistributor' => $dataDistributor,
        ]);
    }

    public function update(SimpanObatRequest $request)
    {
        $validated = $request->validated();

        DB::beginTransaction();
        try {

                DB::table('master_obat')
                ->where('id', $request->id)
                ->update([
                    'nama'              => $validated['nama'],
                    'idSediaan'          => $validated['sediaan'],
                    'idDistributor'     => $validated['distributor'],
                    'idJenis'           => $validated['jenis'],
                    'idKategori'        => $validated['kategori'],
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
            $cek = DB::table('pembelian')->where('idObat',$request->id)->exists();
            if($cek){
                return response()->json([
                    'status' => false,
                    'message' => 'Obat sudah ada di data pembelian, Tidak bisa dihapus!'
                ], 200);
            }

            DB::table('master_obat')->where(['id' => $request->id])->delete();
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
