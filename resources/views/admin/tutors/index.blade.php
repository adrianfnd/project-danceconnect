@extends('layouts.app')

@section('content')
    <div class="page-body">
        <div class="col-sm-12 p-1">
            <div class="d-flex justify-content-between align-items-center m-4">
                <div>
                    <b>
                        <h5>Daftar Tutor</h5>
                    </b>
                </div>
                <div>
                    {{-- <a href="{{ route('tutor.create') }}" class="btn btn-secondary rounded-pill">
                        <span class="plus-icon-bg"><i class="icofont icofont-plus-circle"></i></span> Tutor Baru
                    </a> --}}
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
                                    <th>Bio</th>
                                    <th>
                                        <center>Action</center>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tutors as $index => $tutor)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $tutor->id }}</td>
                                        <td>{{ $tutor->name }}</td>
                                        <td>{{ $tutor->bio }}</td>
                                        <td>
                                            <center>
                                                {{-- <div class="btn-group" role="group">
                                                <a href="{{ route('tutor.show', $tutor->id) }}"
                                                    class="btn btn-info btn-sm rounded-circle"
                                                    style="width: 30px; height: 30px; padding: 0; display: flex; align-items: center; justify-content: center; margin: 5px;">
                                                    <i class="icofont icofont-eye"></i>
                                                </a>
                                                <a href="{{ route('tutor.edit', $tutor->id) }}"
                                                    class="btn btn-warning btn-sm rounded-circle"
                                                    style="width: 30px; height: 30px; padding: 0; display: flex; align-items: center; justify-content: center; margin: 5px;">
                                                    <i class="icofont icofont-edit"></i>
                                                </a>
                                                <form action="{{ route('tutor.destroy', $tutor->id) }}" method="post"
                                                    style="display: inline;">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn btn-danger btn-sm rounded-circle"
                                                        style="width: 30px; height: 30px; padding: 0; display: flex; align-items: center; justify-content: center; margin: 5px;"
                                                        onclick="return confirm('Are you sure you want to delete this tutor?')">
                                                        <i class="icofont icofont-trash"></i>
                                                    </button>
                                                </form>
                                            </div> --}}
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
@endsection