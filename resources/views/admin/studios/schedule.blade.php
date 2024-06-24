@extends('layouts.app')

@section('content')
    <div class="page-body">
        <div class="col-sm-12 p-5">
            <div>
                <h5>{{ $studio->name }} Schedule</h5>
            </div>
            <div class="card">
                <div class="card-body">
                    <div id='calendar'></div>
                </div>
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
