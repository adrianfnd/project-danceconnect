@extends('layouts.app')

@section('content')
<div class="page-body">
    <div class="col-sm-12 p-1" >
        <div class="row justify-content-center">
            <div class="col-md-12 mt-4">
                <div class="card">
                    <div class="card-header">{{ $class->name }} - Class Details</div>
    
                    <div class="card-body">
                        @if($class->image_url)
                            <img src="{{ asset('storage/' . $class->image_url) }}" class="img-fluid mb-3" alt="{{ $class->name }}" style="height: 12cm;">
                        @endif
    
                        <h5>Tutor: {{ $class->tutor->name }}</h5>
                        <p>{{ $class->description }}</p>
                        <p>Start Date and Time: {{ $class->start_at }}</p>
                        <p>Duration: {{ $class->duration }} minutes</p>
                        <p>Price: Rp {{ number_format($class->price, 0, ',', '.') }}</p>
                        <p>Quota: {{ $class->quota }}</p>
    
                        <form action="{{ route('classes.order', $class->id) }}" method="POST">
                            @csrf
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