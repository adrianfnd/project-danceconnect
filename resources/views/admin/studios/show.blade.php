@extends('layouts.app')

@section('content')
    <div class="page-body">
        <div class="col-sm-12 p-1">
            <div class="d-flex justify-content-between align-items-center m-4">
                <div>
                    <h5>Detail Studio</h5>
                </div>
                <div>
                    <a href="{{ route('studios.index') }}" class="btn btn-secondary">Back</a>
                </div>
            </div>
            <div class="card">
                <div class="card-body d-flex align-items-center">
                    <div class="image-section d-flex align-items-center justify-content-center"
                        style="flex: 1; padding-right: 20px;">
                        <img src="{{ asset('storage/' . $studio->image_url) }}" alt="Image" id="imagePreview"
                            style="max-width: 100%; max-height: 400px;">
                    </div>
                    <div class="details-section" style="flex: 2;">
                        <div class="form-group mb-3">
                            <label for="name" class="font-weight-bold" style="color: #555;">Name:</label>
                            <p class="form-control-plaintext" id="name">{{ $studio->name }}</p>
                        </div>
                        <div class="form-group mb-3">
                            <label for="location" class="font-weight-bold" style="color: #555;">Location:</label>
                            <p class="form-control-plaintext" id="location">{{ $studio->location }}</p>
                        </div>
                        <div class="form-group mb-3">
                            <label for="price" class="font-weight-bold" style="color: #555;">Price:</label>
                            <p class="form-control-plaintext" id="price">
                                {{ 'Rp ' . number_format($studio->price, 0, ',', '.') }}</p>
                        </div>
                        <div class="form-group mb-3">
                            <label for="owner" class="font-weight-bold" style="color: #555;">Owner:</label>
                            <p class="form-control-plaintext" id="owner">{{ $studio->owner }}</p>
                        </div>
                        <div class="form-group mb-3">
                            <label for="description" class="font-weight-bold" style="color: #555;">Description:</label>
                            <p class="form-control-plaintext" id="description">{{ $studio->description }}</p>
                        </div>
                        <a href="{{ route('studios.index') }}" class="btn btn-light mt-3">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
