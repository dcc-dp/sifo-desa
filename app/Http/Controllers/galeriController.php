<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class galeriController extends Controller
{
   public function galeri (){
    return view('galeriDesa.galeri');

   }

   public function tambahGambar (){
    return view('galeriDesa.formGaleri');
   }
}
