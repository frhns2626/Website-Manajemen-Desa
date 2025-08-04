@extends('layouts.app')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Penduduk</h1>
        <a href="/penduduk/create" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-plus fa-sm text-white-50"></i> Tambah</a>
    </div>

    {{-- {{Table}} --}}
    <div class="row">
        <div class="col">
            <div class="card shadow">
                <div class="card-body">
                    <table class="table table-responsive table-bordered table-hover">
                        <thead class="text-dark bg-gray-400">
                            <tr>
                                <th class="px-4 py-2">NO</th>
                                <th class="px-4 py-2">NIK</th>
                                <th class="px-4 py-2">KK</th>
                                <th class="px-4 py-2">Nama</th>
                                <th class="px-4 py-2">Jenis Kelamin</th>
                                <th class="px-4 py-2">Tempat, Tanggal Lahir</th>
                                <th class="px-4 py-2">Alamat</th>
                                <th class="px-4 py-2">Agama</th>
                                <th class="px-4 py-2">Status Perkawinan</th>
                                <th class="px-4 py-2">Pekerjaan</th>
                                <th class="px-4 py-2">Pendidikan</th>
                                <th class="px-4 py-2">Status Penduduk</th>
                                <th class="px-4 py-2">Aksi</th>
                            </tr>
                        </thead>
                        @if (count($penduduks) < 1)
                            <tbody>
                                <tr>
                                    <td colspan="13">
                                        <p class="pt-3 text-center">Tidak ada data</p>
                                    </td>
                                </tr>
                            </tbody>
                        @else
                            <tbody>
                                @foreach ($penduduks as $item)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td>{{ $item->nik }}</td>
                                        <td>{{ $item->kk }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->jenis_kelamin }}</td>
                                        <td>{{ $item->tempat_lahir }},
                                            {{ \Carbon\Carbon::parse($item->tanggal_lahir)->translatedFormat('d F Y') }}
                                        </td>
                                        <td>{{ $item->alamat }}</td>
                                        <td>{{ $item->agama }}</td>
                                        <td>{{ $item->status_perkawinan }}</td>
                                        <td>{{ $item->pekerjaan }}</td>
                                        <td>{{ $item->pendidikan }}</td>
                                        <td>{{ $item->status_tinggal }}</td>
                                        <td>
                                            <div class="d-flex">
                                                <a href="/penduduk/{{ $item->id }}"
                                                    class="d-inline-block mr-2 btn btn-sm btn-warning">
                                                    <i class="fas fa-pen"></i>
                                                </a>
                                                <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                                    data-bs-target="#confirmationDelete-{{ $item->id }}">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    @include('pages.penduduk.konfirmasi-hapus')
                                @endforeach
                            </tbody>
                        @endif
                    </table>
                </div>

            </div>
        </div>
    </div>
@endsection
