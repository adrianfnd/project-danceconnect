<?php

namespace App\Http\Controllers;

use App\Models\Tutor;
use App\Models\Classes;
use App\Models\Transaction;
use App\Models\TutorSchedule;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TutorAdminController extends Controller
{
    public function index()
    {
        $tutors = Tutor::all();
        return view('admin.tutors.index', compact('tutors'));
    }

    public function indexClasses()
    {
        $classes = Classes::all();
        return view('admin.tutors.index_classes', compact('classes'));
    }

    public function schedules()
    {
        $classes = Classes::with(['transactions.user', 'transactions.tutorSchedule'])
            ->has('transactions')
            ->get();

        return view('admin.tutors.schedules', compact('classes'));
    }

    public function schedule($id)
    {
        $class = Classes::findOrFail($id);

        $transactions = Transaction::where('class_id', $class->id)->get();

        $events = [];

        foreach ($transactions as $transaction) {
            $events[] = [
                'title' => $transaction->user->name,
                'start' => Carbon::parse($transaction->tutorSchedule->booked_at)->format('Y-m-d\TH:i:s'),
            ];
        }

        return view('admin.tutors.schedule', compact('class', 'events'));
    }
}