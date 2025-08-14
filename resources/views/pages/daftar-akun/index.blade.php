@extends('layouts.app')

@section('content')
    <!-- Page Heading -->
    <div clas4s="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Daftar Akun Penduduk</h1>
    </div>

    @if (session('success'))
        <script>
            Swal.fire({
                title: "Berhasil",
                text: "{{ session()->get('success') }}",
                icon: "successe"
            });
        </script>
    @endif

    {{-- {{Table}} --}}
    <div class="row">
        <div class="col">
            <div class="card shadow">
                <div class="card-body">
                    <div style="overflow-x: auto;">
                        <table class="table table-bordered table-hover" style="min-width: 100%">
                            <thead class="text-dark text-center bg-gray-400">
                                <tr>
                                    <th class="px-4 py-2">NO</th>
                                    <th class="px-4 py-2">Nama</th>
                                    <th class="px-4 py-2">Email</th>
                                    <th class="px-4 py-2">Status</th>
                                    <th class="px-4 py-2">Aksi</th>
                                </tr>
                            </thead>
                            @if (count($users) < 1)
                                <tbody>
                                    <tr>
                                        <td colspan="13">
                                            <p class="pt-3 text-center">Tidak ada data</p>
                                        </td>
                                    </tr>
                                </tbody>
                            @else
                                <tbody>
                                    @foreach ($users as $item)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration + $users->firstItem() - 1 }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->email }}</td>
                                            <td>
                                                <div class="text-center">
                                                    @if ($item->status == 'approved')
                                                        <span class="badge badge-success">Aktif</span>
                                                    @else
                                                        <span class="badge badge-danger">Tidak Aktif</span>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex" style="gap: 10px">
                                                    @if ($item->status == 'approved')
                                                        <button type="button" class="btn btn-sm btn-outline-danger"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#konfirmasiTolak-{{ $item->id }}">
                                                            Non-aktifkan Akun
                                                        </button>
                                                    @else
                                                        <button type="button" class="btn btn-sm btn-outline-success"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#konfirmasiSetuju-{{ $item->id }}">
                                                            Aktifkan Akun
                                                        </button>
                                                    @endif

                                                </div>
                                            </td>
                                        </tr>
                                        @include('pages.daftar-akun.konfirmasi-persetujuan')
                                        @include('pages.daftar-akun.konfirmasi-tolak')
                                    @endforeach
                                </tbody>
                            @endif
                        </table>
                    </div>
                </div>
                @if ($users->lastPage() > 1)
                    <div class="card-footer">
                        {{ $users->links('pagination::bootstrap-5') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
