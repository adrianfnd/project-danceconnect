@extends('layouts.app')

@section('content')
    <div class="page-body">
        <div class="col-sm-12 p-1">
            <div class="d-flex justify-content-between align-items-center m-4">
                <div>
                    <h5>Detail Tutor</h5>
                </div>
                <div>
                    <a href="{{ route('tutors.index') }}" class="btn btn-secondary">Back</a>
                </div>
            </div>
            <div class="card">
                <div class="card-body d-flex align-items-center">
                    <div class="image-section d-flex align-items-center justify-content-center"
                        style="flex: 1; padding-right: 20px;">
                        <img src="{{ asset('storage/' . $tutor->image_url) }}" alt="Image" id="imagePreview"
                            style="max-width: 100%; max-height: 400px;">
                    </div>
                    <div class="details-section" style="flex: 2;">
                        <div class="form-group mb-3">
                            <label for="name" class="font-weight-bold" style="color: #555;">Name:</label>
                            <p class="form-control-plaintext" id="name">{{ $tutor->name }}</p>
                        </div>
                        <div class="form-group mb-3">
                            <label for="bio" class="font-weight-bold" style="color: #555;">Bio:</label>
                            <p class="form-control-plaintext" id="bio">{{ $tutor->bio }}</p>
                        </div>
                        <a href="{{ route('tutors.index') }}" class="btn btn-light mt-3">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
