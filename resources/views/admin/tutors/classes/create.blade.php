@extends('layouts.app')

@section('content')
    <div class="page-body">
        <div class="col-sm-12 p-1">
            <div class="d-flex justify-content-between align-items-center m-4">
                <h5>Buat Kelas Baru</h5>
            </div>
            <div class="card">
                <div class="card-body">
                    <form id="createForm" action="{{ route('classes.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group mb-3">
                                    <label for="name">Class Name</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        value="{{ old('name') }}" placeholder="Class Name" required>
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="start_at">Class Start At</label>
                                    <input type="text" class="form-control" id="start_at" name="start_at"
                                        value="{{ old('start_at') }}" placeholder="Class Start At" required>
                                    @error('start_at')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label for="quota">Class Quota</label>
                                    <input type="number" class="form-control" id="quota" name="quota"
                                        value="{{ old('quota') }}" placeholder="Class Quota" required>
                                    @error('quota')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="duration">Class Duration (minutes)</label>
                                    <input type="number" class="form-control" id="duration" name="duration"
                                        value="{{ old('duration') }}" placeholder="Class Duration" required>
                                    @error('duration')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label for="price">Class Price</label>
                                    <input type="number" class="form-control" id="price" name="price"
                                        value="{{ old('price') }}" placeholder="Class Price" required>
                                    @error('price')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group mb-3">
                                    <label for="description">Class Description</label>
                                    <textarea class="form-control" id="description" name="description" placeholder="Class Description" rows="5">{{ old('description') }}</textarea>
                                    @error('description')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label for="tutor_id">Class Tutor</label>
                                    <select class="form-control" id="tutor_id" name="tutor_id" required>
                                        <option value="">Select Tutor</option>
                                        @foreach ($tutors as $tutor)
                                            <option value="{{ $tutor->id }}"
                                                {{ old('tutor_id') == $tutor->id ? 'selected' : '' }}>
                                                {{ $tutor->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group mb-3" id="tutorInfo" style="display: none;">
                                    <img id="tutorImage" src="" alt="Tutor Image" style="max-width: 200px;">
                                    <p id="tutorBio"></p>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="image">Class Image</label>
                                    <input type="file" class="form-control" id="image" name="image"
                                        accept="image/*" onchange="previewImage(event)">
                                    <img id="imagePreview" style="max-width: 300px; margin-top: 10px;" />
                                    @error('image')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <button type="button" class="btn btn-primary" onclick="submitCreateForm()">Create</button>
                                <a href="{{ route('classes.index') }}" class="btn btn-light">Back</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    <script>
        $(document).ready(function() {
            flatpickr("#start_at", {
                enableTime: true,
                dateFormat: "Y-m-d H:i",
            });

            $('#tutor_id').change(function() {
                var tutorId = $(this).val();
                if (tutorId) {
                    $.ajax({
                        url: '/get-tutor-info/' + tutorId,
                        type: 'GET',
                        success: function(data) {
                            $('#tutorName').text(data.name);
                            $('#tutorImage').attr('src', data.image_url);
                            $('#tutorBio').text(data.bio);
                            $('#tutorInfo').show();
                        }
                    });
                } else {
                    $('#tutorInfo').hide();
                }
            });
        });

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
                text: "Data kelas baru akan ditambahkan!",
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
