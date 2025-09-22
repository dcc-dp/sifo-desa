<?php

namespace App\Http\Controllers;

use App\Models\Galeri;
use Illuminate\Http\Request;

class GaleriController extends Controller
{
    //
    public function index(){
        $galeri=Galeri::all();
        return view('admin.galeri.galeri',compact('galeri'));
    }

    public function tambah(){
        return view ('admin.galeri.upload');
    }

    


}
