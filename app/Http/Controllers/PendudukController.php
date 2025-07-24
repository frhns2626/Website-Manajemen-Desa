<?php

namespace App\Http\Controllers;

use App\Models\Penduduk;
use Illuminate\Http\Request;

class PendudukController extends Controller
{
    public function index()
    {
        $penduduks = Penduduk::all();
        return view('pages.penduduk.index', [
            'penduduks' => $penduduks,
        ]);
    }

    public function create()
    {
        return view('pages.penduduk.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nik'              => 'required|digits:16',
            'kk'               => 'required|digits:16',
            'nama'             => 'required|string|max:255',
            'jenis_kelamin'    => 'required|in:pria,wanita',
            'tempat_lahir'     => 'required|string|max:100',
            'tanggal_lahir'    => 'required|date',
            'alamat'           => 'required|string',
            'agama'            => 'required|string|max:50',
            'status_perkawinan' => 'required|in:belum_kawin,kawin,cerai',
            'pekerjaan'        => 'required|string|max:100',
            'pendidikan'       => 'required|string|max:100',
            'status_tinggal'   => 'required|in:tetap,pendatang,pindah,meninggal',
        ]);

        Penduduk::create($request->validated());

        return redirect('/penduduk')->with('success', 'Berhasil menambahkan data');
    }

    public function edit($id)
    {
        $penduduk = Penduduk::findOrFail($id);
        return view('pages.penduduk.edit', [
            'penduduk' => $penduduk
        ]);
    }

    public function update(Penduduk $request, $id)
    {
        $validated = $request->validate([
            'nik'              => 'required|digits:16',
            'kk'               => 'required|digits:16',
            'nama'             => 'required|string|max:255',
            'jenis_kelamin'    => 'required|in:pria,wanita',
            'tempat_lahir'     => 'required|string|max:100',
            'tanggal_lahir'    => 'required|date',
            'alamat'           => 'required|string',
            'agama'            => 'required|string|max:50',
            'status_perkawinan' => 'required|in:belum_kawin,kawin,cerai',
            'pekerjaan'        => 'required|string|max:100',
            'pendidikan'       => 'required|string|max:100',
            'kewarganegaraan'  => 'required|string|max:50',
            'status_tinggal'   => 'required|in:tetap,pendatang,pindah,meninggal',
        ]);

        Penduduk::findOrFail($id)->update($request->validated());

        return redirect('/penduduk')->with('success', 'Berhasil mengubah data');
    }

    public function destroy($id)
    {
        $penduduk = Penduduk::findOrFail($id);
        $penduduk->delete();

        return redirect('/resident')->with('success', 'Berhasil menghapus data');
    }
}
