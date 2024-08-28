@extends('layouts.app')

@section('content')
<div class="page-body">
    <div class="col-sm-12 p-1">
        <div class="d-flex justify-content-between align-items-center m-4">
            <div>
                <b><h5>Kelas Dance</h5></b>
            </div>
        </div>

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <div class="card" style="margin-bottom: 0;">
            <div class="card-body" style="padding: 1;">
                <div class="table-responsive">
                    <div class="row">
                        @foreach($classes as $class)
                        <div class="col-md-4 col-sm-6 mb-4">
                            <div class="card h-100 shadow-sm hover-shadow-lg transition-300">
                                <div class="position-relative">
                                    <img src="{{ asset('storage/' . $class->image_url) }}" class="card-img-top" alt="{{ $class->name }}" style="height: 14cm;">
                                    <div class="position-absolute top-0 end-0 p-2 bg-primary text-white">
                                        <small>{{ $class->duration }} min</small>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title text-primary">{{ $class->name }}</h5>
                                    <p class="card-text text-muted">{{ Str::limit($class->description, 80) }}</p>
                                </div>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <span><i data-feather="calendar" class="text-primary me-2"></i> Start</span>
                                        <span class="badge bg-light text-dark">{{ \Carbon\Carbon::parse($class->start_at)->format('M d, Y H:i') }}</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <span><i data-feather="users" class="text-primary me-2"></i> Quota</span>
                                        <span class="badge bg-primary">{{ $class->quota }}</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <span><i data-feather="tag" class="text-primary me-2"></i> Price</span>
                                        <span class="badge bg-success">Rp {{ number_format($class->price, 0, ',', '.') }}</span>
                                    </li>
                                </ul>
                                <div class="card-footer bg-white border-top-0">
                                    <a href="/classes/{{ $class->id }}/detail" class="btn btn-primary btn-sm w-100">View Details</a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-between align-items-center m-4">
            <div>
                <b><h5>Studio</h5></b>
            </div>
        </div>

        <div class="card" style="margin-bottom: 0;">
            <div class="card-body" style="padding: 1;">
                <div class="table-responsive">
                    <div class="row flex-nowrap overflow-auto pb-3">
                        @foreach($studios as $studio)
                        <div class="col-md-4 col-sm-6">
                            <div class="card h-100 shadow-sm hover-shadow-lg transition-300">
                                <div class="position-relative">
                                    <img src="{{ asset('storage/' . $studio->image_url) }}" class="card-img-top" alt="{{ $studio->name }} " style="height: 14cm;">
                                    <div class="position-absolute bottom-0 start-0 p-3 bg-dark bg-opacity-75 text-white w-100">
                                        <h5 class="mb-0">{{ $studio->name }}</h5>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <p class="card-text text-muted">{{ Str::limit($studio->description, 100) }}</p>
                                </div>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <span><i data-feather="map-pin" class="text-danger me-2"></i> Location</span>
                                        <span class="badge bg-light text-dark">{{ $studio->location }}</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <span><i data-feather="user" class="text-primary me-2"></i> Owner</span>
                                        <span class="badge bg-light text-dark">{{ $studio->owner }}</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <span><i data-feather="tag" class="text-success me-2"></i> Price</span>
                                        <span class="badge bg-success">Rp {{ number_format($studio->price, 0, ',', '.') }}</span>
                                    </li>
                                </ul>
                                <div class="card-footer bg-white border-top-0">
                                    <a href="/studios/{{ $studio->id }}/detail" class="btn btn-primary btn-sm w-100">View Details</a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script>
        feather.replace();

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
    .transition-300 {
        transition: all 0.3s ease-in-out;
    }
    .hover-shadow-lg:hover {
        box-shadow: 0 1rem 3rem rgba(0,0,0,.175)!important;
    }
</style>
@endpush
