@extends('layouts.app')

@section('content')
    <div class="page-body">
        <div class="col-sm-12 p-1">
            <div class="d-flex justify-content-between align-items-center m-4">
                <div>
                    <b>
                        <h5>Daftar Jadwal Tutor & Class</h5>
                    </b>
                </div>
            </div>
            @foreach ($classes as $class)
                <div class="card mb-3">
                    <div class="card-header">
                        <h5>{{ $class->name }}</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="show-case" style="margin-bottom: 0;">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Booked At</th>
                                        <th>
                                            <center>Action</center>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($class->transactions as $index => $transaction)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $transaction->id }}</td>
                                            <td>{{ $transaction->user->name }}</td>
                                            <td>{{ (new DateTime($transaction->tutorSchedule->booked_at))->format('l, d F Y h:i A') }}
                                            </td>
                                            <td>
                                                <center>
                                                    <a href="{{ url('/tutors-classes-' . $class->id) }}"
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
            @endforeach
        </div>
    </div>
@endsection
