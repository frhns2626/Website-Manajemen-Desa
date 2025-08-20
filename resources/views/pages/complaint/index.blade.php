@extends('layouts.app')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{ auth()->user()->role_id == \App\Models\Role::ROLE_ADMIN ? 'Aduan Warga' : 'Aduan Warga' }}</h1>
        @if (isset(auth()->user()->penduduk))
            <a href="/complaint/create" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-plus fa-sm text-white-50"></i> Buat Aduan</a>
        @endif
    </div>

    @if (session('success'))
        <script>
            Swal.fire({
                title: "Berhasil!",
                text: "{{ session()->get('success') }}",
                icon: "success"
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            Swal.fire({
                title: "Terjadi Kesalahan!",
                text: "{{ session()->get('error') }}",
                icon: "error"
            });
        </script>
    @endif
    {{-- {{Table}} --}}
    <div class="row">
        <div class="col">
            <div class="card shadow">
                <div class="card-body">
                    <table class="table table-responsive table-bordered table-hover">
                        <thead class="text-dark bg-gray-400">
                            <tr>
                                <th class="px-4 py-2">NO</th>
                                @if (auth()->user()->role_id == \App\Models\Role::ROLE_ADMIN)
                                    <th>Nama Penduduk</th>
                                @endif
                                <th class="px-4 py-2">Judul</th>
                                <th class="px-4 py-2">Isi Aduan</th>
                                <th class="px-4 py-2">Status</th>
                                <th class="px-4 py-2">Foto Bukti</th>
                                <th class="px-4 py-2">Tanggal Laporan</th>
                                <th class="px-4 py-2">Aksi</th>
                            </tr>
                        </thead>
                        @if (count($complaints) < 1)
                            <tbody>
                                <tr>
                                    <td colspan="13">
                                        <p class="pt-3 text-center">Tidak ada data</p>
                                    </td>
                                </tr>
                            </tbody>
                        @else
                            <tbody>
                                @foreach ($complaints as $item)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration + $complaints->firstItem() - 1 }}</td>
                                        @if (auth()->user()->role_id == \App\Models\Role::ROLE_ADMIN)
                                            <td>{{ $item->penduduk->name }}</td>
                                        @endif
                                        <td>{{ $item->title }}</td>
                                        <td>{!! wordwrap($item->content, 50, "<br>\n") !!}</td>
                                        <td>
                                            <span
                                                class="badge badge-{{ $item->status_color }}">{{ $item->status_label }}</span>
                                        </td>
                                        <td>
                                            @if (isset($item->photo_proof))
                                                @php
                                                    $filePath = 'storage/' . $item->photo_proof;
                                                @endphp
                                                <a href="{{ $filePath }}" target="_blank" rel="noopener noreferrer">
                                                    <img src="{{ $filePath }}" alt="Foto Bukti"
                                                        style="max-width: 140px;">
                                                </a>
                                            @else
                                                Tidak Ada
                                            @endif
                                        </td>
                                        <td>{{ $item->report_date_label }}
                                        </td>
                                        <td>
                                            @if (auth()->user()->role_id == \App\Models\Role::ROLE_USER && isset(auth()->user()->penduduk) && $item->status == 'new')
                                                <div class="d-flex align-items-center" style="gap: 10px">
                                                    <a href="/complaint/{{ $item->id }}"
                                                        class="d-inline-block btn btn-sm btn-warning">
                                                        <i class="fas fa-pen"></i>
                                                    </a>
                                                    <button type="button" class="btn btn-sm btn-danger"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#konfirmasiHapus-{{ $item->id }}">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </div>
                                            @elseif (auth()->user()->role_id == \App\Models\Role::ROLE_ADMIN)
                                                <div>
                                                    <form id="formChangeStatus-{{ $item->id }}"
                                                        action="/complaint/update-status/{{ $item->id }}"
                                                        method="post">
                                                        @csrf
                                                        @method('POST')
                                                        <div class="form-group">
                                                            <select name="status" id="status" class="form-control"
                                                                style="min-width: 150px;"
                                                                oninput="document.getElementById('formChangeStatus-{{ $item->id }}').submit()">
                                                                @foreach ([
            (object)
    [
                'label' => 'Baru',
                'value' => 'new',
            ],
            (object) [
                'label' => 'Sedang Diproses',
                'value' => 'processing',
            ],
            (object) [
                'label' => 'Selesai',
                'value' => 'completed',
            ],
        ] as $status)
                                                                    <option value="{{ $status->value }}"
                                                                        @selected($item->status == $status->value)>
                                                                        {{ $status->label }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </form>
                                                </div>
                                            @endif
                                        </td>
                                    </tr>
                                    @include('pages.complaint.konfirmasi-hapus')
                                @endforeach
                            </tbody>
                        @endif
                    </table>
                </div>
                @if ($complaints->lastPage() > 1)
                    <div class="card-footer">
                        {{ $complaints->links('pagination::bootstrap-5') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
