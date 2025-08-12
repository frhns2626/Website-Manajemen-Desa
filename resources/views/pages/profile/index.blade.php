@extends('layouts.app')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail Profil</h1>
    </div>

    @if (session('success'))
        <script>
            Swal.fire({
                title: "Berhasil",
                text: "{{ session()->get('success') }}",
                icon: "success"
            });
        </script>
    @endif
    <div class="row">
        <div class="col">
            <form action="/profile/{{ auth()->user()->id }}" method="post">
                @csrf
                @method('POST')
                <div class="card">
                    <div class="card-body">
                        <div class="form-group mb-3">
                            <label for="email">Email</label>
                            <input type="email" inputmode="email" name="email" id="email"
                                class="form-control @error('email') is-invalid @enderror"
                                value="{{ old('email', auth()->user()->email) }}" readonly>
                            @error('email')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="name">Nama Lengkap :</label>
                            <input type="text" inputmode="numeric" name="name" id="name"
                                class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name', auth()->user()->name) }}">
                            @error('name')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="d-flex justify-content-end" style="gap: 10px">
                            <a href="/dashboard" class="btn btn-outline-secondary">Kembali</a>
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
