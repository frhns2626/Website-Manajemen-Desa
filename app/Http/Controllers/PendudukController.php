<?php

namespace App\Http\Controllers;

use App\Models\Penduduk;
use Illuminate\Http\Request;

class PendudukController extends Controller
{
    public function index()
    {
        $penduduks = Penduduk::with('user')->get();
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
        $validatedData = $request->validate([
            'nik'              => 'required|digits:16',
            'kk'               => 'required|digits:16',
            'name'             => 'required|string|max:255',
            'jenis_kelamin'    => 'required|in:Laki-Laki,Perempuan',
            'tempat_lahir'     => 'required|string|max:100',
            'tanggal_lahir'    => 'required|date',
            'alamat'           => 'required|string',
            'agama'            => 'required|in:islam,kristen,katolik,hindu,buddha,konghucu',
            'status_perkawinan' => 'required|in:belum kawin,kawin,cerai hidup,cerai mati',
            'pekerjaan'        => 'required|in:Belum/Tidak Bekerja,Pelajar/Mahasiswa,Mengurus Rumah Tangga,Pegawai Negeri Sipil (PNS),TNI,Polri,Karyawan Swasta,Karyawan BUMN,Petani/Pekebun,Pedagang,Nelayan,Wiraswasta,Guru,Dosen,Dokter,Perawat,Sopir,Buruh Harian Lepas,Tukang Bangunan,Pensiunan,Lainnya',
            'pendidikan'       => 'required|in:Tidak Sekolah,Belum Tamat SD / Sederajat,SD / MI,SMP / SLTP Sederajat,SMA / SLTA Sederajat,D1,D2,D3,D4 / S1,S2,S3',
            'status_tinggal'   => 'required|in:tetap,pendatang,pindah,meninggal',
        ]);

        Penduduk::create($validatedData);

        return redirect('/penduduk')->with('success', 'Berhasil menambahkan data');
    }

    public function edit($id)
    {
        $penduduk = Penduduk::findOrFail($id);
        return view('pages.penduduk.edit', [
            'penduduk' => $penduduk,
        ]);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nik'              => 'required|digits:16',
            'kk'               => 'required|digits:16',
            'name'             => 'required|string|max:255',
            'jenis_kelamin'    => 'required|in:Laki-Laki,Perempuan',
            'tempat_lahir'     => 'required|string|max:100',
            'tanggal_lahir'    => 'required|date',
            'alamat'           => 'required|string',
            'agama'            => 'required|in:islam,kristen,katolik,hindu,buddha,konghucu',
            'status_perkawinan' => 'required|in:belum kawin,kawin,cerai hidup,cerai mati',
            'pekerjaan'        => 'required|in:Belum/Tidak Bekerja,Pelajar/Mahasiswa,Mengurus Rumah Tangga,Pegawai Negeri Sipil (PNS),TNI,Polri,Karyawan Swasta,Karyawan BUMN,Petani/Pekebun,Pedagang,Nelayan,Wiraswasta,Guru,Dosen,Dokter,Perawat,Sopir,Buruh Harian Lepas,Tukang Bangunan,Pensiunan,Lainnya',
            'pendidikan'       => 'required|in:Tidak Sekolah,Belum Tamat SD / Sederajat,SD / MI,SMP / SLTP Sederajat,SMA / SLTA Sederajat,D1,D2,D3,D4 / S1,S2,S3',
            'status_tinggal'   => 'required|in:tetap,pendatang,pindah,meninggal',
        ]);

        Penduduk::findOrFail($id)->update($validatedData);

        return redirect('/penduduk')->with('success', 'Berhasil mengubah data');
    }

    public function destroy($id)
    {
        Penduduk::where('id', $id)->delete();

        return redirect('/penduduk')->with('success', 'Berhasil menghapus data');
    }
}
