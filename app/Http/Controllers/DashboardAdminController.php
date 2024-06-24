<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use Carbon\Carbon;
use DB;

class DashboardAdminController extends Controller
{
    public function index()
    {
        $now = Carbon::now();
        $startOfMonth = $now->startOfMonth();
        $endOfMonth = $now->endOfMonth();
    
        $thisMonthEarnings = Transaction::where('status', 'complete')
                ->whereBetween('created_at', [$startOfMonth, $endOfMonth])
                ->sum('amount_paid');

        $totalEarnings = Transaction::where('status', 'complete')
                ->whereBetween('created_at', [$startOfMonth, $endOfMonth])
                ->sum('amount_paid');
        $thisMonthTotalTransactions = Transaction::whereBetween('created_at', [$startOfMonth, $endOfMonth])
                ->count();
        $thisMonthCompletedTransactions = Transaction::where('status', 'complete')
                ->whereBetween('created_at', [$startOfMonth, $endOfMonth])
                ->count();
        $thisMonthPercentage = $thisMonthTotalTransactions ? ($thisMonthCompletedTransactions / $thisMonthTotalTransactions) * 100 : 0;

        $weeklyEarnings = [];
        $weekStart = $startOfMonth->copy();
        while ($weekStart->lessThanOrEqualTo($endOfMonth)) {
            $weekEnd = $weekStart->copy()->endOfWeek();
            if ($weekEnd->greaterThan($endOfMonth)) {
                $weekEnd = $endOfMonth;
            }

            $studioEarnings = Transaction::where('status', 'complete')
                ->whereNotNull('studio_id')
                ->whereBetween('created_at', [$weekStart, $weekEnd])
                ->sum('amount_paid');

            $tutorEarnings = Transaction::where('status', 'complete')
                ->whereNotNull('tutor_id')
                ->whereBetween('created_at', [$weekStart, $weekEnd])
                ->sum('amount_paid');

            $weeklyEarnings[] = [
                'week' => $weekStart->format('W'),
                'studio' => $studioEarnings,
                'tutor' => $tutorEarnings,
            ];

            $weekStart = $weekStart->copy()->addWeek();
        }

        $studioEarnings = Transaction::where('status', 'complete')
            ->whereNotNull('studio_id')
            ->sum('amount_paid');
    
        $tutorEarnings = Transaction::where('status', 'complete')
            ->whereNotNull('tutor_id')
            ->sum('amount_paid');
    
        $earningsByCategory = [
            ['category' => 'Studio', 'total' => $studioEarnings],
            ['category' => 'Tutor', 'total' => $tutorEarnings]
        ];

        $totalClasses = DB::table('classes')->count();
        $totalTutors = DB::table('tutors')->count();
        $totalStudios = DB::table('studios')->count();

        $totalTransactionAmount = Transaction::sum('amount_paid');
        $totalTransactions = Transaction::count();
        $completedTransactions = Transaction::where('status', 'complete')
                ->count();
        $completionPercentage = $totalTransactions ? ($completedTransactions / $totalTransactions) * 100 : 0;
    
        return view('admin.dashboard', compact(
            'thisMonthEarnings',
            'thisMonthPercentage',
            'weeklyEarnings',
            'earningsByCategory',
            'totalClasses',
            'totalTutors',
            'totalStudios',
            'totalTransactionAmount',
            'completionPercentage'
        ));
    }
    
}

