@extends('layouts.app')

@section('content')
    <div class="page-body">
        <div class="col-sm-12 p-1">
            <div class="d-flex justify-content-between align-items-center m-4">
                <div>
                    <b>
                        <h5>Daftar Jadwal Studio</h5>
                    </b>
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
                                        <td>
                                            <center>
                                                <a href="{{ url('/studios-' . $studio->id) }}"
                                                    class="btn btn-info btn-sm rounded-circle"
                                                    style="width: 30px; height: 30px; padding: 0; display: flex; align-items: center; justify-content: center; margin: 5px;">
                                                    <i class="icofont icofont-calendar"></i>
                                                </a>
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
