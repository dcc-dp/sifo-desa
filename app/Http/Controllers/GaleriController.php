<?php

namespace App\Http\Controllers;

use App\Models\BatchGaleri;
use App\Models\Galeri;
use Illuminate\Bus\Batch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class GaleriController extends Controller
{
    //
    public function index(){
    $BatchGaleri=BatchGaleri::all();

        return view('admin.galeri.index',compact('BatchGaleri'));
    }

    public function detail($id){
    $Galeri=Galeri::where('id_batch',$id)->get();
        return view('admin.galeri.detail',compact('Galeri', 'id'));
    }


    public function tambah(){
        return view ('admin.galeri.tambah');
    }

    public function tambahProses(Request $request){

        $request->validate([
            'nama'=>'required'
        ]);
        BatchGaleri::create([
            'nama'=>$request->nama
        ]);
        
        return redirect()->route('galeri');
    }

    public function hapus(Request $request){
        $batch = BatchGaleri::findOrFail($request->id);
        $gambar = Galeri::where('id_batch', $batch->id)->get();
        foreach ($gambar as $g){
            $path = public_path('assets/img/galeri/' . $g->gambar);

            if (File::exists($path)) {
                File::delete($path);
            }

            $g->delete();
        }
        $batch->delete();
        
        return redirect()->route('galeri');
    }

    public function tambahDetail($id){

        return view('admin.galeri.tambahDetail', compact('id'));
    }

    public function tambahDetailProses(Request $request, $id){
        $request->validate([
            'gambar'=>'required'
        ]);

        $file = $request->file('gambar'); // ambil file dari input
        $namaFile = time() . '_' . $file->getClientOriginalName(); // bikin nama unik
        $file->move(public_path('assets/img/galeri'), $namaFile);
        Galeri::create([
            'id_batch'=>$id,
            'gambar'=> $namaFile
        ]);

        return redirect()->route('detailGaleri', $id);
    }

    public function hapusDetail(Request $request, $id){
        $galeri = Galeri::findOrFail($request->id);

        $path = public_path('assets/img/galeri/' . $galeri->gambar);

        if (File::exists($path)) {
            File::delete($path);
        }

        $galeri->delete();
        
        return redirect()->route('detailGaleri', $id);
    }

}
