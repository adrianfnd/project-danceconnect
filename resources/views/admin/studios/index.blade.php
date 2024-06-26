@extends('layouts.app')

@section('content')
    <div class="page-body">
        <div class="col-sm-12 p-1">
            <div class="d-flex justify-content-between align-items-center m-4">
                <div>
                    <b>
                        <h5>Daftar Studio</h5>
                    </b>
                </div>
                <div>
                    <a href="{{ route('studios.create') }}" class="btn btn-secondary rounded-pill">
                        <span class="plus-icon-bg"><i class="icofont icofont-plus-circle"></i></span> Studio Baru
                    </a>
                </div>
            </div>
            <div class="card" style="margin-bottom: 0;">
                <div class="card-body" style="padding: 1;">
                    <div class="table-responsive">
                        <table class="show-case" style="margin-bottom: 0;">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Location</th>
                                    <th>Owner</th>
                                    <th>Price</th>
                                    <th>
                                        <center>Action</center>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($studios as $index => $studio)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $studio->id }}</td>
                                        <td>{{ $studio->name }}</td>
                                        <td>{{ $studio->location }}</td>
                                        <td>{{ $studio->owner }}</td>
                                        <td>{{ 'Rp ' . number_format($studio->price, 0, ',', '.') }}</td>
                                        <td>
                                            <center>
                                                <div class="btn-group" role="group">
                                                    <a href="{{ route('studios.show', $studio->id) }}"
                                                        class="btn btn-info btn-sm rounded-circle"
                                                        style="width: 30px; height: 30px; padding: 0; display: flex; align-items: center; justify-content: center; margin: 5px;">
                                                        <i class="icofont icofont-eye"></i>
                                                    </a>
                                                    <a href="{{ route('studios.edit', $studio->id) }}"
                                                        class="btn btn-warning btn-sm rounded-circle"
                                                        style="width: 30px; height: 30px; padding: 0; display: flex; align-items: center; justify-content: center; margin: 5px;">
                                                        <i class="icofont icofont-edit"></i>
                                                    </a>
                                                    <button type="button"
                                                        class="btn btn-danger btn-sm rounded-circle delete-button"
                                                        style="width: 30px; height: 30px; padding: 0; display: flex; align-items: center; justify-content: center; margin: 5px;"
                                                        data-id="{{ $studio->id }}">
                                                        <i class="icofont icofont-trash"></i>
                                                    </button>
                                                </div>
                                            </center>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var deleteButtons = document.querySelectorAll('.delete-button');

            deleteButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    var studioId = this.getAttribute('data-id');

                    Swal.fire({
                        title: 'Apakah Anda yakin?',
                        text: "Anda tidak akan bisa mengembalikan data ini!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya, hapus!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            var form = document.createElement('form');
                            form.action = '{{ url('studios-') }}' + studioId;
                            form.method = 'POST';
                            form.style.display = 'none';

                            var csrfInput = document.createElement('input');
                            csrfInput.name = '_token';
                            csrfInput.value = '{{ csrf_token() }}';
                            csrfInput.type = 'hidden';
                            form.appendChild(csrfInput);

                            var methodInput = document.createElement('input');
                            methodInput.name = '_method';
                            methodInput.value = 'DELETE';
                            methodInput.type = 'hidden';
                            form.appendChild(methodInput);

                            document.body.appendChild(form);
                            form.submit();
                        }
                    });
                });
            });

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
        });
    </script>
@endsection
