<?php
namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Http\Requests\Master\SimpanKategoriObatRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Laravel\Prompts\Table;
use Yajra\DataTables\Facades\DataTables;

class MasterGudangController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Master Kategori Obat'
        ];
        return view('master.kategoriobat.index')->with($data);
    }

    public function load(Request $request)
    {
        $data = DB::table('master_gudang')
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
        $query = DB::table('master_gudang')
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

    public function save(SimpanKategoriObatRequest $request)
    {
        $validated = $request->validated();
        // cek apakah sudah ada Distributor
        $cek = DB::table('master_gudang')->where([
                    'nama'      => $validated['nama'],
                ])->count();
        if($cek>0){
            return response()->json([
                'status' => false,
                'message' => 'Data Sudah ada!'
            ], 200);
        }
        DB::beginTransaction();
        try {
            // simpan
            DB::table('master_gudang')
                ->insert([
                    'nama'              => $validated['nama'],
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
        $data = DB::table('master_gudang')
            ->where(['id' => $id])
            ->first();

        return response()->json([
            'data' => $data,
        ]);
    }

    public function update(SimpanKategoriObatRequest $request)
    {
        $validated = $request->validated();

        DB::beginTransaction();
        try {

                DB::table('master_gudang')
                ->where('id', $request->id)
                ->update([
                    'nama'      => $validated['nama'],
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
            DB::table('master_gudang')->where(['id' => $request->id])->delete();
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
