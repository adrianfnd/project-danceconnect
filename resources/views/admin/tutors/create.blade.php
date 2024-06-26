@extends('layouts.app')

@section('content')
    <div class="page-body">
        <div class="col-sm-12 p-1">
            <div class="d-flex justify-content-between align-items-center m-4">
                <div>
                    <h5>Buat Tutor Baru</h5>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <form id="createForm" action="{{ route('tutors.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name"
                                value="{{ old('name') }}" placeholder="Name" required>
                            @if ($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                        <div class="form-group mb-3">
                            <label for="bio">Bio</label>
                            <textarea class="form-control" id="bio" name="bio" placeholder="Bio" rows="5">{{ old('bio') }}</textarea>
                            @if ($errors->has('bio'))
                                <span class="text-danger">{{ $errors->first('bio') }}</span>
                            @endif
                        </div>
                        <div class="form-group mb-3">
                            <label for="image">Image</label>
                            <input type="file" class="form-control" id="image" name="image" accept="image/*"
                                onchange="previewImage(event)">
                            <img id="imagePreview" style="max-width: 300px; margin-top: 10px;" />
                            @if ($errors->has('image'))
                                <span class="text-danger">{{ $errors->first('image') }}</span>
                            @endif
                        </div>
                        <button type="button" class="btn btn-primary mt-3" onclick="submitCreateForm()">Create</button>
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
            };
            reader.readAsDataURL(event.target.files[0]);
        }

        function submitCreateForm() {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data tutor baru akan ditambahkan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, tambah!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('createForm').submit();
                }
            })
        }
    </script>
@endsection
