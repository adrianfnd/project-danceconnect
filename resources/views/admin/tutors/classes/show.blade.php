@extends('layouts.app')

@section('content')
    <div class="page-body">
        <div class="col-sm-12 p-1">
            <div class="d-flex justify-content-between align-items-center m-4">
                <h5>Detail Kelas</h5>
                <a href="{{ route('classes.index') }}" class="btn btn-secondary">Back</a>
            </div>
            <div class="card">
                <div class="card-body d-flex align-items-center">
                    <div class="image-section d-flex align-items-center justify-content-center"
                        style="flex: 1; padding-right: 20px;">
                        <img src="{{ asset('storage/' . $class->image_url) }}" alt="Class Image" id="imagePreview"
                            style="max-width: 100%; max-height: 400px;">
                    </div>
                    <div class="details-section" style="flex: 2;">
                        <div class="form-group mb-3">
                            <label class="font-weight-bold" style="color: #555;">Class Name:</label>
                            <p class="form-control-plaintext">{{ $class->name }}</p>
                        </div>
                        <div class="form-group mb-3">
                            <label class="font-weight-bold" style="color: #555;">Class Start At:</label>
                            <p class="form-control-plaintext">{{ $class->start_at }}</p>
                        </div>
                        <div class="form-group mb-3">
                            <label class="font-weight-bold" style="color: #555;">Class Quota:</label>
                            <p class="form-control-plaintext">{{ $class->quota }}</p>
                        </div>
                        <div class="form-group mb-3">
                            <label class="font-weight-bold" style="color: #555;">Class Duration:</label>
                            <p class="form-control-plaintext">{{ $class->duration }} minutes</p>
                        </div>
                        <div class="form-group mb-3">
                            <label class="font-weight-bold" style="color: #555;">Class Price:</label>
                            <p class="form-control-plaintext">{{ 'Rp ' . number_format($class->price, 0, ',', '.') }}</p>
                        </div>
                        <div class="form-group mb-3">
                            <label class="font-weight-bold" style="color: #555;">Class Description:</label>
                            <p class="form-control-plaintext">{{ $class->description }}</p>
                        </div>
                        <div class="form-group mb-3">
                            <label class="font-weight-bold" style="color: #555;">Class Tutor:</label>
                            <p class="form-control-plaintext">
                                <a href="{{ route('tutors.show', $class->tutor->id) }}">
                                    {{ $class->tutor->name }}
                                </a>
                            </p>
                        </div>
                        <a href="{{ route('classes.edit', $class->id) }}" class="btn btn-primary mt-3">Edit</a>
                        <a href="{{ route('classes.index') }}" class="btn btn-light mt-3">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
