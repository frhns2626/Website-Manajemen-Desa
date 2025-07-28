@extends('layouts.app')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tambah Penduduk</h1>
    </div>

    <div class="row">
        <div class="col">
            <form action="/penduduk" method="post">
                @csrf
                @method('POST')
                <div class="card">
                    <div class="card-body">
                        <div class="form-group mb-3">
                            <label for="nik">No NIK :</label>
                            <input type="text" inputmode="numeric" maxlength="16" name="nik" id="nik"
                                class="form-control @error('nik') is-invalid @enderror" value="{{ old('nik') }}"
                                required>
                            @error('nik')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="kk">No KK :</label>
                            <input type="text" inputmode="numeric" maxlength="16" name="kk" id="kk"
                                class="form-control @error('kk') is-invalid @enderror" value="{{ old('kk') }}" required>
                            @error('kk')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="name">Nama Lengkap :</label>
                            <input type="text" inputmode="numeric" name="name" id="name"
                                class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}"
                                required>
                            @error('name')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="jenis_kelamin">Jenis Kelamin :</label>
                            <select name="jenis_kelamin" id="jenis_kelamin"
                                class="form-control @error('jenis_kelamin') is-invalid @enderror" required>
                                <option value="">-- Pilih --</option>
                                <option value="Laki-Laki" {{ old('jenis_kelamin') == 'Laki-Laki' ? 'selected' : '' }}>
                                    Laki-Laki</option>
                                <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>
                                    Perempuan</option>
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
                            <textarea name="alamat" id="alamat" class="form-control @error('alamat') is-invalid @enderror" required>{{ old('alamat') }}</textarea>
                            @error('alamat')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="agama">Agama :</label>
                            <select name="agama" id="agama" class="form-control @error('agama') is-invalid @enderror"
                                required>
                                <option value="">-- Pilih --</option>
                                <option value="islam" {{ old('agama') == 'islam' ? 'selected' : '' }}>Islam</option>
                                <option value="kristen"{{ old('agama') == 'kristen' ? 'selected' : '' }}>Kristen Protestan
                                </option>
                                <option value="katolik"{{ old('agama') == 'katolik' ? 'selected' : '' }}>Katolik</option>
                                <option value="hindu"{{ old('agama') == 'hindu' ? 'selected' : '' }}>Hindu</option>
                                <option value="buddha"{{ old('agama') == 'buddha' ? 'selected' : '' }}>Buddha</option>
                                <option value="konghucu"{{ old('agama') == 'konghucu' ? 'selected' : '' }}>Konghucu
                                </option>
                            </select>
                            @error('agama')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="status_perkawinan">Status :</label>
                            <select name="status_perkawinan" id="status_perkawinan"
                                class="form-control @error('status_perkawinan') is-invalid @enderror">
                                <option value="">-- Pilih --</option>
                                <option value="belum kawin"
                                    {{ old('status_perkawinan') == 'belum kawin' ? 'selected' : '' }}>
                                    Belum Kawin</option>
                                <option value="kawin" {{ old('status_perkawinan') == 'kawin' ? 'selected' : '' }}>
                                    Kawin</option>
                                <option value="cerai hidup"
                                    {{ old('status_perkawinan') == 'cerai hidup' ? 'selected' : '' }}>
                                    Cerai Hidup</option>
                                <option value="cerai mati"
                                    {{ old('status_perkawinan') == 'cerai mati' ? 'selected' : '' }}>
                                    Cerai Mati</option>
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
                                <option value="Belum/Tidak Bekerja"
                                    {{ old('pekerjaan') == 'Belum/Tidak Bekerja' ? 'selected' : '' }}>
                                    Belum/Tidak Bekerja</option>
                                <option value="Pelajar/Mahasiswa"
                                    {{ old('pekerjaan') == 'Pelajar/Mahasiswa' ? 'selected' : '' }}>
                                    Pelajar/Mahasiswa</option>
                                <option value="Mengurus Rumah Tangga"
                                    {{ old('pekerjaan') == 'Mengurus Rumah Tangga' ? 'selected' : '' }}>
                                    Mengurus Rumah Tangga</option>
                                <option value="Pegawai Negeri Sipil (PNS)"
                                    {{ old('pekerjaan') == 'Pegawai Negeri Sipil (PNS)' ? 'selected' : '' }}>
                                    Pegawai Negeri Sipil (PNS)</option>
                                <option value="TNI" {{ old('pekerjaan') == 'TNI' ? 'selected' : '' }}>
                                    TNI</option>
                                <option value="Polri" {{ old('pekerjaan') == 'Polri' ? 'selected' : '' }}>
                                    Polri</option>
                                <option value="Karyawan Swasta"
                                    {{ old('pekerjaan') == 'Karyawan Swasta' ? 'selected' : '' }}>
                                    Karyawan Swasta</option>
                                <option value="Karyawan BUMN" {{ old('pekerjaan') == 'Karyawan BUMN' ? 'selected' : '' }}>
                                    Karyawan BUMN</option>
                                <option value="Petani/Pekebun"
                                    {{ old('pekerjaan') == 'Petani/Pekebun' ? 'selected' : '' }}>
                                    Petani/Pekebun</option>
                                <option value="Pedagang" {{ old('pekerjaan') == 'Pedagang' ? 'selected' : '' }}>
                                    Pedagang</option>
                                <option value="Nelayan"{{ old('pekerjaan') == 'Nelayan' ? 'selected' : '' }}>
                                    Nelayan</option>
                                <option value="Wiraswasta"
                                    {{ old('pekerjaan') == 'Belum/Tidak Bekerja' ? 'selected' : '' }}>
                                    Wiraswasta</option>
                                <option value="Guru"{{ old('pekerjaan') == 'Guru' ? 'selected' : '' }}>
                                    Guru</option>
                                <option value="Dosen"{{ old('pekerjaan') == 'Dosen' ? 'selected' : '' }}>
                                    Dosen</option>
                                <option value="Dokter"{{ old('pekerjaan') == 'Dokter' ? 'selected' : '' }}>
                                    Dokter</option>
                                <option value="Perawat"{{ old('pekerjaan') == 'Perawat' ? 'selected' : '' }}>
                                    Perawat</option>
                                <option value="Sopir"{{ old('pekerjaan') == 'Sopir' ? 'selected' : '' }}>
                                    Sopir</option>
                                <option
                                    value="Buruh Harian Lepas"{{ old('pekerjaan') == 'Buruh Harian Lepas' ? 'selected' : '' }}>
                                    Buruh Harian Lepas</option>
                                <option
                                    value="Tukang Bangunan"{{ old('pekerjaan') == 'Tukang Bangunan' ? 'selected' : '' }}>
                                    Tukang Bangunan</option>
                                <option value="Pensiunan"{{ old('pekerjaan') == 'Pensiunan' ? 'selected' : '' }}>
                                    Pensiunan</option>
                                <option value="Lainnya"{{ old('pekerjaan') == 'Lainnya' ? 'selected' : '' }}>
                                    Lainnya</option>
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
                                <option value="Tidak Sekolah"
                                    {{ old('pendidikan') == 'Tidak Sekolah' ? 'selected' : '' }}>
                                    Tidak
                                    Sekolah</option>
                                <option value="Belum Tamat SD / Sederajat"
                                    {{ old('pendidikan') == 'Belum Tamat SD / Sederajat' ? 'selected' : '' }}>
                                    Belum
                                    Tamat SD / Sederajat</option>
                                <option value="SD / MI" {{ old('pendidikan') == 'SD / MI' ? 'selected' : '' }}>SD / MI
                                </option>
                                <option value="SMP / SLTP Sederajat"
                                    {{ old('pendidikan') == 'SMP / SLTP Sederajat' ? 'selected' : '' }}>
                                    SMP /
                                    SLTP Sederajat</option>
                                <option value="SMA / SLTA Sederajat"
                                    {{ old('pendidikan') == 'SMA / SLTA Sederajat' ? 'selected' : '' }}>
                                    SMA /
                                    SLTA Sederajat</option>
                                <option value="D1" {{ old('pendidikan') == 'D1' ? 'selected' : '' }}>Diploma I
                                    (D1)</option>
                                <option value="D2" {{ old('pendidikan') == 'D2' ? 'selected' : '' }}>Diploma
                                    II (D2)</option>
                                <option value="D3" {{ old('pendidikan') == 'D3' ? 'selected' : '' }}>Diploma
                                    III (D3)</option>
                                <option value="D4 / S1" {{ old('pendidikan') == 'D4 / S1' ? 'selected' : '' }}>Sarjana
                                    (D4 / S1)</option>
                                <option value="S2" {{ old('pendidikan') == 'S2' ? 'selected' : '' }}>Magister
                                    (S2)</option>
                                <option value="S3" {{ old('pendidikan') == 'S3' ? 'selected' : '' }}>Doktor
                                    (S3)</option>
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
                                <option value="tetap" {{ old('status_tinggal') == 'tetap' ? 'selected' : '' }}>
                                    Tetap
                                </option>
                                <option value="pendatang" {{ old('status_tinggal') == 'pendatang' ? 'selected' : '' }}>
                                    Pendatang</option>
                                <option value="pindah" {{ old('status_tinggal') == 'pindah' ? 'selected' : '' }}>
                                    Pindah
                                </option>
                                <option value="meninggal" {{ old('status_tinggal') == 'meninggal' ? 'selected' : '' }}>
                                    Meninggal</option>
                            </select>
                            @error('status_tinggal')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
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
