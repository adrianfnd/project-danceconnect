@extends('layouts.app')

@section('content')
    <div class="page-body">
        <div class="col-sm-12 p-5">
            <div>
                <h5>Detail Transaksi</h5>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col">
                            <label class="form-label"><b>Transaction ID:</b></label>
                            <span class="form-control-plaintext">{{ $transaction->id }}</span>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label class="form-label"><b>Amount:</b></label>
                            <span class="form-control-plaintext">Rp
                                {{ number_format($transaction->amount, 0, ',', '.') }}</span>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label class="form-label"><b>Date Created:</b></label>
                            <span
                                class="form-control-plaintext">{{ (new DateTime($transaction->created_at))->format('l, d F Y h:i A') }}
                            </span>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label class="form-label"><b>Status:</b></label>
                            <span class="form-control-plaintext">
                                @if (strtolower($transaction->status) == 'complete')
                                    <span class="badge badge-success">Complete</span>
                                @elseif (strtolower($transaction->status) == 'pending')
                                    <span class="badge badge-warning">Pending</span>
                                @elseif (strtolower($transaction->status) == 'failed')
                                    <span class="badge badge-danger">Failed</span>
                                @else
                                    <span class="badge badge-secondary">{{ ucfirst($transaction->status) }}</span>
                                @endif
                            </span>
                        </div>
                    </div>
                    @if ($transaction->studio)
                        <div class="row mb-3">
                            <div class="col">
                                <label class="form-label"><b>Studio:</b></label>
                                <span class="form-control-plaintext">{{ $transaction->studio->name }}</span>
                            </div>
                        </div>
                    @endif
                    @if ($transaction->tutor)
                        <div class="row mb-3">
                            <div class="col">
                                <label class="form-label"><b>Tutor:</b></label>
                                <span class="form-control-plaintext">{{ $transaction->tutor->name }}</span>
                            </div>
                        </div>
                    @endif
                    @if ($transaction->class)
                        <div class="row mb-3">
                            <div class="col">
                                <label class="form-label"><b>Class:</b></label>
                                <span class="form-control-plaintext">{{ $transaction->class->name }}</span>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <div class="mt-4">
                <h5>Calendar</h5>
            </div>
            <div class="card">
                <div class="card-body">
                    <div id="calendar"></div>
                </div>
            </div>

            <div class="mt-4">
                <a href="{{ url('/transactions') }}" class="btn btn-primary">Back</a>
            </div>
        </div>
    </div>

    <!-- FullCalendar CSS -->
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.css' rel='stylesheet' />
    <!-- FullCalendar JS -->
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.js'></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                events: @json($events)
            });
            calendar.render();
        });
    </script>
@endsection
