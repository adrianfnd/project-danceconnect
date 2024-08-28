@extends('layouts.app')

@section('content')
    <div class="page-body">
        <div class="col-sm-12 p-1" >
            <div class="row justify-content-center">
                <div class="col-md-12 mt-4">
                    <div class="card">
                        <div class="card-header">{{ $studio->name }} - Studio Details</div>

                        <div class="card-body">
                            @if($studio->image_url)
                                <img src="{{ asset('storage/' . $studio->image_url) }}" class="img-fluid mb-3" alt="{{ $studio->name }}">
                            @endif

                            <h5>Location: {{ $studio->location }}</h5>
                            <p>{{ $studio->description }}</p>
                            <p>Owner: {{ $studio->owner }}</p>
                            <p>Price: Rp {{ number_format($studio->price, 0, ',', '.') }}</p>

                            <form action="{{ route('studios.order', $studio->id) }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="booked_at">Choose Date and Time:</label>
                                    <input type="datetime-local" class="form-control" id="booked_at" name="booked_at" required>
                                </div>
                                <div class="d-flex justify-content-start mt-3">
                                    <button type="submit" class="btn btn-primary">Book Now</button>
                                    <a href="javascript:history.back()" class="btn btn-primary ms-2">Back</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection