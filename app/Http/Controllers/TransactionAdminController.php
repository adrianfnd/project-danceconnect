<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TransactionAdminController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with(['studio', 'tutor', 'class'])
                                ->orderBy('created_at', 'desc')
                                ->get();
        
        return view('admin.transactions.index', compact('transactions'));
    }

    public function show($id)
    {
        $transaction = Transaction::with(['studio', 'tutor', 'class'])->findOrFail($id);

        if ($transaction->studio_id) {
            $events[] = [
                'title' => 'Studio Booking',
                'start' => Carbon::parse($transaction->studioSchedule->booked_at)->format('Y-m-d\TH:i:s'),
            ];
        } else {
            $events[] = [
                'title' => 'Tutor Booking',
                'start' => Carbon::parse($transaction->tutorSchedule->booked_at)->format('Y-m-d\TH:i:s'),
            ];
        }

        return view('admin.transactions.show', compact('transaction', 'events'));
    }
}