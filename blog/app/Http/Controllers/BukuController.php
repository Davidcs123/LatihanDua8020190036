<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BukuController extends Controller
{
    public function index(Request $request)
    { 
        $data['objek'] = \App\Buku::latest()->paginate(10);
        return view('buku_index', $data);
    }

    public function tambah()
    {
        $data['objek'] = new \App\Buku();
        $data['action'] = 'BukuController@simpan';
        $data['method'] = 'POST';
        $data['nama_tombol'] = 'SIMPAN';
        return view('buku_form', $data);
    }

    public function simpan(Request $request)
    {
        $request->validate([
            'id' => 'required|min:1',
            'judul' => 'required|min:2',
            'pengarang' => 'required|min:2'
        ]);
        $objek = new \App\Buku();
        $objek->id = $request->id;
        $objek->judul = $request->judul;
        $objek->pengarang = $request->pengarang;
        $objek->save();
        return back()->with('pesan', 'data sudah disimpan');
    }
}
