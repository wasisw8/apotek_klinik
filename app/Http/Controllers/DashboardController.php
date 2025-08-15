<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Dashboard'
        ];
        return view('dashboard')->with($data);
    }
}
