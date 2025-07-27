@extends('layouts.app')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Ubah Data Penduduk</h1>
    </div>

    <div class="row">
        <div class="col">
            <form action="/penduduk/{{ $penduduk->id }}" method="post">
                @csrf
                @method('PUT')
                <div class="card">
                    <div class="card-body">
                        <div class="form-group mb-3">
                            <label for="nik">No NIK :</label>
                            <input type="text" inputmode="numeric" maxlength="16" name="nik" id="nik"
                                class="form-control @error('nik') is-invalid @enderror"
                                value="{{ old('nik', $penduduk->nik) }}" required>
                            @error('nik')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="kk">No KK :</label>
                            <input type="text" inputmode="numeric" maxlength="16" name="kk" id="kk"
                                class="form-control @error('kk') is-invalid @enderror"
                                value="{{ old('kk', $penduduk->kk) }}" required>
                            @error('kk')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="name">Nama Lengkap :</label>
                            <input type="text" inputmode="numeric" name="name" id="name"
                                class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name', $penduduk->name) }}" required>
                            @error('name')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="jenis_kelamin">Jenis Kelamin :</label>
                            <select name="jenis_kelamin" id="jenis_kelamin"
                                class="form-control @error('jenis_kelamin') is-invalid @enderror" required>
                                <option value="">-- Pilih --</option>
                                <option value="Laki-Laki">Laki-Laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                            @error('jenis_kelamin')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="tempat_lahir">Tempat Lahir :</label>
                            <input type="text" name="tempat_lahir" id="tempat_lahir"
                                class="form-control @error('tempat_lahir') is-invalid @enderror"
                                value="{{ old('tempat_lahir') }}" required>
                            @error('tempat_lahir')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="tanggal_lahir">Tanggal Lahir</label>
                            <input type="date" name="tanggal_lahir" id="tanggal_lahir"
                                class="form-control @error('tanggal_lahir') is-invalid @enderror"
                                value="{{ old('tanggal_lahir') }}" required>
                            @error('tanggal_lahir')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="alamat">Alamat :</label>
                            <textarea name="alamat" id="alamat" class="form-control @error('alamat') is-invalid @enderror"
                                value="{{ old('alamat') }}" required></textarea>
                            @error('alamat')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="agama">Agama :</label>
                            <input type="text" name="agama" id="agama"
                                class="form-control @error('agama') is-invalid @enderror" value="{{ old('agama') }}"
                                required>
                            @error('agama')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="status_perkawinan">Status :</label>
                            <select name="status_perkawinan" id="status_perkawinan"
                                class="form-control @error('status_perkawinan') is-invalid @enderror">
                                <option value="">-- Pilih --</option>
                                <option value="belum kawin">Belum Kawin</option>
                                <option value="kawin">Kawin</option>
                                <option value="cerai hidup">Cerai Hidup</option>
                                <option value="cerai mati">Cerai Mati</option>
                            </select>
                            @error('status_perkawinan')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="pekerjaan">Pekerjaan :</label>
                            <select name="pekerjaan" id="pekerjaan"
                                class="form-control @error('pekerjaan') is-invalid @enderror" required>
                                <option value="">-- Pilih --</option>
                                <option value="Belum/Tidak Bekerja">Belum/Tidak Bekerja</option>
                                <option value="Pelajar/Mahasiswa">Pelajar/Mahasiswa</option>
                                <option value="Mengurus Rumah Tangga">Mengurus Rumah Tangga</option>
                                <option value="Pegawai Negeri Sipil (PNS)">Pegawai Negeri Sipil (PNS)</option>
                                <option value="TNI">TNI</option>
                                <option value="Polri">Polri</option>
                                <option value="Karyawan Swasta">Karyawan Swasta</option>
                                <option value="Karyawan BUMN">Karyawan BUMN</option>
                                <option value="Petani/Pekebun">Petani/Pekebun</option>
                                <option value="Pedagang">Pedagang</option>
                                <option value="Nelayan">Nelayan</option>
                                <option value="Wiraswasta">Wiraswasta</option>
                                <option value="Guru">Guru</option>
                                <option value="Dosen">Dosen</option>
                                <option value="Dokter">Dokter</option>
                                <option value="Perawat">Perawat</option>
                                <option value="Sopir">Sopir</option>
                                <option value="Buruh Harian Lepas">Buruh Harian Lepas</option>
                                <option value="Tukang Bangunan">Tukang Bangunan</option>
                                <option value="Pensiunan">Pensiunan</option>
                                <option value="Lainnya">Lainnya</option>
                            </select>
                            @error('pekerjaan')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="pendidikan">Pendidikan :</label>
                            <select name="pendidikan" id="pendidikan"
                                class="form-control @error('pendidikan') is-invalid @enderror" required>
                                <option value="">-- Pilih --</option>
                                <option value="Tidak Sekolah">Tidak Sekolah</option>
                                <option value="Belum Tamat SD / Sederajat">Belum Tamat SD / Sederajat</option>
                                <option value="SD / MI">SD / MI</option>
                                <option value="SMP / SLTP Sederajat">SMP / SLTP Sederajat</option>
                                <option value="SMA / SLTA Sederajat">SMA / SLTA Sederajat</option>
                                <option value="D1">Diploma I (D1)</option>
                                <option value="D2">Diploma II (D2)</option>
                                <option value="D3">Diploma III (D3)</option>
                                <option value="D4 / S1">Sarjana (D4 / S1)</option>
                                <option value="S2">Magister (S2)</option>
                                <option value="S3">Doktor (S3)</option>
                            </select>
                            @error('pendidikan')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="status_tinggal">Status Tinggal :</label>
                            <select name="status_tinggal" id="status_tinggal"
                                class="form-control @error('status_tinggal') is-invalid @enderror" required>
                                <option value="">-- Pilih --</option>
                                <option value="tetap">Tetap</option>
                                <option value="pendatang">Pendatang</option>
                                <option value="pindah">Pindah</option>
                                <option value="meninggal">Meninggal</option>
                            </select>
                            @error('status_tinggal')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="d-flex justify-content-end" style="gap: 10px">
                            <a href="/penduduk" class="btn btn-outline-secondary">Kembali</a>
                            <button type="submit" class="btn btn-primary">
                                Simpan
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        const fields = ['nik', 'kk'];

        fields.forEach(id => {
            const input = document.getElementById(id);
            input.addEventListener('input', function() {
                this.value = this.value.replace(/\D/g, '').slice(0, 16);
            })
        });
    </script>
@endsection
