<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DataPendudukController extends Controller
{
   public function index(){
        return view('admin.penduduk.index');
   }
}
