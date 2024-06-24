@extends('layouts.app')

@section('content')
    <div class="page-body">
        <div class="col-sm-12 p-1">
            <div class="d-flex justify-content-between align-items-center m-4">
                <div>
                    <b>
                        <h5>Daftar Kelas</h5>
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
                                    <th>Start At</th>
                                    <th>Tutor</th>
                                    <th>Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($classes as $index => $class)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $class->id }}</td>
                                        <td>{{ $class->name }}</td>
                                        <td>{{ (new DateTime($class->start_at))->format('l, d F Y h:i A') }}</td>
                                        <td>{{ $class->tutor->name }}</td>
                                        <td>{{ 'Rp ' . number_format($class->price, 0, ',', '.') }}</td>
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
