<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pemerintah;
use Illuminate\Http\Request;

class PemerintahController extends Controller
{
    public function index()
    {
        $datas = Pemerintah::all();
        return view('admin.pemerintah.index', compact('datas'));
    }
}
