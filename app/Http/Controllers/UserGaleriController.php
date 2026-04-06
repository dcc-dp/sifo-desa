<?php

namespace App\Http\Controllers;

use App\Models\BatchGaleri;

class UserGaleriController extends Controller
{
    public function index()
    {
        $batches = BatchGaleri::with(['galeris' => function($query) {
            $query->orderBy('created_at', 'desc'); 
        }])->get();
        
        return view('pages.profildesa.galeri', compact('batches'));
    }

    public function show(BatchGaleri $batch)
    {
        $batch->load(['galeris' => function($query) {
            $query->orderBy('created_at', 'desc');
        }]);
        
        return view('pages.profildesa.show', compact('batch'));
    }
}