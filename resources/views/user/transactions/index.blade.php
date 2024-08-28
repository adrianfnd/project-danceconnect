@extends('layouts.app')

@section('content')
    <div class="page-body">
        <div class="col-sm-12 p-1">
            <div class="d-flex justify-content-between align-items-center m-4">
                <div>
                    <b>
                        <h5>Daftar Transaksi {{ auth()->user()->name }}</h5>
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
                                    <th>User</th>
                                    <th>Email</th>
                                    <th>Type</th>
                                    <th>Details</th>
                                    <th>Amount</th>
                                    <th>
                                        <center>Status</center>
                                    </th>
                                    <th>
                                        <center>Action</center>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($transactions as $index => $transaction)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $transaction->id }}</td>
                                        <td>{{ $transaction->user->name }}</td>
                                        <td>{{ $transaction->user->email }}</td>
                                        <td>{{ $transaction->studio_id ? 'Studio' : 'Tutor' }}</td>
                                        <td>
                                            @if ($transaction->studio_id)
                                                Studio: {{ $transaction->studio->name }}
                                            @else
                                                Tutor: {{ $transaction->tutor->name }}<br>
                                                Class: {{ $transaction->class->name }}
                                            @endif
                                        </td>
                                        <td>{{ 'Rp ' . number_format($transaction->amount, 0, ',', '.') }}</td>
                                        <td>
                                            <center>
                                                @if (strtolower($transaction->status) == 'complete')
                                                    <span class="badge badge-success">Complete</span>
                                                @elseif (strtolower($transaction->status) == 'pending')
                                                    <span class="badge badge-warning">Pending</span>
                                                @elseif (strtolower($transaction->status) == 'failed')
                                                    <span class="badge badge-danger">Failed</span>
                                                @else
                                                    <span
                                                        class="badge badge-secondary">{{ ucfirst($transaction->status) }}</span>
                                                @endif
                                            </center>
                                        </td>
                                        <td>
                                            <center>
                                                <a href="{{ url('/usertransactions-' . $transaction->id) }}"
                                                    class="btn btn-info btn-sm rounded-circle"
                                                    style="width: 30px; height: 30px; padding: 0; display: flex; align-items: center; justify-content: center; margin: 5px;">
                                                    <i class="icofont icofont-eye"></i>
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
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script>
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
    </script>
@endsection
