<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use App\Models\Berita;
use App\Models\Kategori;
use App\Models\PemerintahDesa;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('laravel-examples.users-management', compact('users'));
    }

    public function home()
    {
        $berita = Berita::orderBy('created_at', 'desc')->whereNotNull('gambar')->take(3)->get();
        $pemerintah =  PemerintahDesa::take(1)->get(); 
        $agenda = Agenda::take(6)->get();
        return view('pages.home', compact('berita','pemerintah', 'agenda'));
    }

    public function pemerintah()
    {
        $pemerintahs = PemerintahDesa::all();
        return view('pages/profildesa/pemerintah', compact('pemerintahs'));
    }


   public function kategori()
    {
        $kategoris = Kategori::withCount('beritas')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('pages/pengaduandanberita/kategori', compact('kategoris'));
    }
    public function detailBerita($slug)
    {
        $berita = Berita::with('kategori')
            ->where('slug', $slug)
            ->firstOrFail();

        return view('pages.pengaduandanberita.detailberita', compact('berita'));
    }
    public function showKategori($slug)
    {
        $kategori = Kategori::where('slug', $slug)->firstOrFail();

        $beritas = Berita::where('id_kategori', $kategori->id)->orderBy('created_at', 'desc')->get();

        return view('pages/pengaduandanberita/berita', compact('kategori', 'beritas'));
    }


    public function berita()
    {
        $beritas = Berita::all();
        $kategori = Kategori::all();
        return view('pages/pengaduandanberita/berita', compact('beritas', 'kategori'));
    }

    public function agenda()
    {
        $agendas = Agenda::all();
        return view('pages/pengaduandanberita/agenda', compact('agendas'));
    }
}
