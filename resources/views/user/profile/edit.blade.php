@extends('layouts.app')

@section('content')
<div class="page-body">
    <div class="col-sm-12 p-1">
        <div class="d-flex justify-content-between align-items-center m-4">
            <div>
                <b><h5>Edit Profil</h5></b>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <div class="card">
            <div class="card-body">
                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="name">Nama</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ auth()->user()->name }}" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ auth()->user()->email }}" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Phone</label>
                                <input type="text" class="form-control" id="phone_number" name="phone_number" value="{{ auth()->user()->phone_number }}" required>
                            </div>
                            <div class="form-group">
                                <label for="role">Role</label>
                                <input type="text" class="form-control" id="role" name="role" value="{{ auth()->user()->role->name ?? 'User' }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="created_at">Tanggal Bergabung</label>
                                <input type="text" class="form-control" id="created_at" name="created_at" value="{{ auth()->user()->created_at->format('d M Y') }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="password">Password Baru (Opsional)</label>
                                <input type="password" class="form-control" id="password" name="password">
                            </div>
                            <div class="form-group">
                                <label for="password_confirmation">Konfirmasi Password Baru</label>
                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                            </div>
                            <div class="mt-3">
                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                <a href="{{ url('profile') }}" class="btn btn-primary btn-sm">Back</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script>
    var successMessage = '{{ session('success') }}';
    var errorMessage = '{{ session('error') }}';

    if (successMessage) {
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: successMessage,
            showConfirmButton: false,
            timer: 2000
        });
    }

    if (errorMessage) {
        Swal.fire({
            icon: 'error',
            title: 'Gagal!',
            text: errorMessage,
            showConfirmButton: false,
            timer: 2000
        });
    }
</script>
@endsection

@push('styles')
<style>
    .rounded-circle {
        border-radius: 50%;
    }
</style>
@endpush
