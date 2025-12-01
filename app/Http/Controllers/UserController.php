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

    public function pemerintah()
    {
        $pemerintahs = PemerintahDesa::all();
        return view('pages/profildesa/pemerintah', compact('pemerintahs'));
    }

    public function kategori(){
        $kategoris = Kategori::all();
        $beritaCount = Berita::count();
        return view('pages/pengaduandanberita/beritas', compact('kategoris', 'beritaCount'));
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
