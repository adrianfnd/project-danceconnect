@extends('layouts.app')

@section('content')
<div class="page-body">
    <div class="col-sm-12 p-1">
        <div class="d-flex justify-content-between align-items-center m-4">
            <div>
                <b><h5>Profil Pengguna</h5></b>
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
                <div class="row">
                    <div class="col-md-4 text-center">
                        <h4>{{ auth()->user()->name }}</h4>
                        <p class="text-muted">{{ auth()->user()->email }}</p>
                        <a href="{{ route('profile.edit') }}" class="btn btn-primary btn-sm">Edit Profile</a>
                        <a href="{{ url('/') }}" class="btn btn-primary btn-sm">Back</a>
                    </div>
                    <div class="col-md-8">
                        <ul class="list-group">
                            <li class="list-group-item">
                                <strong>Nama :</strong> {{ auth()->user()->name }}
                            </li>
                            <li class="list-group-item">
                                <strong>Email :</strong> {{ auth()->user()->email }}
                            </li>
                            <li class="list-group-item">
                                <strong>Phone :</strong> {{ auth()->user()->phone_number }}
                            </li>
                            <li class="list-group-item">
                                <strong>Role :</strong> {{ auth()->user()->role->name ?? 'User' }}
                            </li>
                            <li class="list-group-item">
                                <strong>Tanggal Bergabung :</strong> {{ auth()->user()->created_at->format('d M Y') }}
                            </li>
                        </ul>
                    </div>
                </div>
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
