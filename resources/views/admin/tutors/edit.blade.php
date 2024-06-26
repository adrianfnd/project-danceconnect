@extends('layouts.app')

@section('content')
    <div class="page-body">
        <div class="col-sm-12 p-1">
            <div class="d-flex justify-content-between align-items-center m-4">
                <div>
                    <h5>Edit Tutor</h5>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <form id="updateForm" action="{{ route('tutors.update', $tutor->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group mb-3">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name"
                                value="{{ old('name', $tutor->name) }}" placeholder="Name" required>
                            @if ($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                        <div class="form-group mb-3">
                            <label for="bio">Bio</label>
                            <textarea class="form-control" id="bio" name="bio" placeholder="Bio" rows="5">{{ old('bio', $tutor->bio) }}</textarea>
                            @if ($errors->has('bio'))
                                <span class="text-danger">{{ $errors->first('bio') }}</span>
                            @endif
                        </div>
                        <div class="form-group mb-3">
                            <label for="image">Image</label>
                            <input type="file" class="form-control" id="image" name="image" accept="image/*"
                                onchange="previewImage(event)">
                            <img src="{{ asset('storage/' . $tutor->image_url) }}" alt="Image" id="imagePreview"
                                style="max-width: 300px; margin-top: 10px;">
                            @if ($errors->has('image'))
                                <span class="text-danger">{{ $errors->first('image') }}</span>
                            @endif
                        </div>
                        <button type="button" class="btn btn-primary mt-3" onclick="submitUpdateForm()">Update</button>
                        <a href="{{ route('tutors.index') }}" class="btn btn-light mt-3">Back</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script>
        function previewImage(event) {
            var reader = new FileReader();
            reader.onload = function() {
                var output = document.getElementById('imagePreview');
                output.src = reader.result;
                output.style.display = 'block';
            };
            reader.readAsDataURL(event.target.files[0]);
        }

        function submitUpdateForm() {
            Swal.fire({
                title: 'Apakan anda yakin?',
                text: "Data tutor ini akan diupdate!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, update!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('updateForm').submit();
                }
            })
        }
    </script>
@endsection
