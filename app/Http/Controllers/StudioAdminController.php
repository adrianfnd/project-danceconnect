<?php

namespace App\Http\Controllers;

use App\Models\Studio;
use App\Models\StudioSchedule;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Carbon\Carbon;

class StudioAdminController extends Controller
{
    public function index()
    {
        $studios = Studio::all();
        return view('admin.studios.index', compact('studios'));
    }

    public function schedules()
    {
        $studios = Studio::all();
        return view('admin.studios.schedules', compact('studios'));
    }

    public function schedule($id)
    {
        $studio = Studio::findOrFail($id);

        $transactions = Transaction::where('studio_id', $studio->id)->get();

        $events = [];

        foreach ($transactions as $transaction) {
            $events[] = [
                'title' => $transaction->user->name,
                'start' => Carbon::parse($transaction->studioSchedule->booked_at)->format('Y-m-d\TH:i:s'),
            ];
        }

        return view('admin.studios.schedule', compact('studio', 'events'));
    }
}