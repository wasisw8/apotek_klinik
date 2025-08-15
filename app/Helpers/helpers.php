<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

// function filter_menu()
// {
//     $id = Auth::user()->id;
//     $hak_akses = DB::table('members as a')
//         ->join('roles as c', 'a.role_id', '=', 'c.id')
//         ->join('role_has_permissions as d', 'c.id', '=', 'd.role_id')
//         ->join('permissions as e', 'd.permission_id', '=', 'e.id')
//         ->select('e.*')
//         ->where(['a.id' => $id, 'e.isMenu' => '1'])
//         ->orderBy('e.urutMenu')
//         ->get();

//     return $hak_akses;
// }

// function sub_menu()
// {
//     $id = Auth::user()->id;

//     $hak_akses = DB::table('members as a')
//         ->join('roles as c', 'a.role_id', '=', 'c.id')
//         ->join('role_has_permissions as d', 'c.id', '=', 'd.role_id')
//         ->join('permissions as e', 'd.permission_id', '=', 'e.id')
//         ->select('e.*')
//         ->where(['a.id' => $id])
//         ->where(['e.isSubMenu' => '1'])
//         ->orderBy('e.urutSubMenu')
//         ->get();

//     return $hak_akses;
// }

function getName($table, $columnSelect, $columnWhere, $valueWhere)
{
    $data = DB::table($table)
        ->select($columnSelect)
        ->where($columnWhere, $valueWhere)
        ->first();

    // Cek kalau data ada
    return $data ? $data->$columnSelect : null;
}

if (!function_exists('tanggal_indonesia')) {
    function tanggal_indonesia($tanggal, $format = 'l, d F Y')
    {
        if (!$tanggal) {
            return '-';
        }

        // Set locale ke Indonesia
        Carbon::setLocale('id');

        return Carbon::parse($tanggal)->translatedFormat($format);
    }
}

if (!function_exists('tanggal_indonesia2')) {
    function tanggal_indonesia2($tanggal, $format = 'd F Y')
    {
        if (!$tanggal) {
            return '-';
        }

        // Set locale ke Indonesia
        Carbon::setLocale('id');

        return Carbon::parse($tanggal)->translatedFormat($format);
    }
}

if (!function_exists('bulan_indonesia')) {
    function bulan_indonesia($bulan)
    {
        // Pastikan input adalah angka 1-12
        $daftarBulan = [
            1  => 'Januari', 2  => 'Februari', 3  => 'Maret', 4  => 'April',
            5  => 'Mei', 6  => 'Juni', 7  => 'Juli', 8  => 'Agustus',
            9  => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
        ];

        return $daftarBulan[(int)$bulan] ?? 'Bulan Tidak Valid';
    }
}

if (!function_exists('bulan_list')) {
    function bulan_list()
    {
        return [
            '01' => 'Januari',
            '02' => 'Februari',
            '03' => 'Maret',
            '04' => 'April',
            '05' => 'Mei',
            '06' => 'Juni',
            '07' => 'Juli',
            '08' => 'Agustus',
            '09' => 'September',
            '10' => 'Oktober',
            '11' => 'November',
            '12' => 'Desember',
        ];
    }
}

if (!function_exists('tahun_list')) {
    function tahun_list($start = -5, $end = 5)
    {
        $tahunSekarang = date('Y');
        $range = range($tahunSekarang + $start, $tahunSekarang + $end);
        return array_combine($range, $range);
    }
}
