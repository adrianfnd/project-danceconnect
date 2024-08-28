<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Password;
use App\Models\Transaction;
use App\Models\Classes;
use App\Models\Studio;
use Carbon\Carbon;
use App\Models\User;
use App\Models\TutorSchedule;
use App\Models\StudioSchedule;
use DB;

class DashboardUserController extends Controller
{
    public function userdashboard()
    {
        $classes = Classes::all();
        $studios = Studio::all();
        
        return view('user.userdashboard', compact('classes', 'studios'));
    }
    
    public function classDetail($id)
    {
        if (!auth()->check()) {
            return redirect()->route('login')->withErrors(['auth' => 'Silakan login untuk mengakses halaman ini.']);
        }

        $class = Classes::findOrFail($id);

        return view('user.classes.detail', compact('class'));
    }

    public function orderClass(Request $request, $id)
    {
        $class = Classes::findOrFail($id);
        $user = auth()->user();

        $bookedCount = Transaction::where('class_id', $class->id)
            ->where('status', '!=', 'cancelled')
            ->count();

        if ($bookedCount >= $class->quota) {
            return redirect()->route('classes.index')->with('error', 'This class has reached its maximum quota.');
        }

        $transaction = new Transaction();
        $transaction->user_id = $user->id;
        $transaction->class_id = $class->id;
        $transaction->tutor_id = $class->tutor_id;
        $transaction->amount = $class->price;
        $transaction->status = 'pending';
        $transaction->save();

        $tutorSchedule = new TutorSchedule();
        $tutorSchedule->tutor_id = $class->tutor_id;
        $tutorSchedule->user_id = $user->id;
        $tutorSchedule->booked_at = $class->start_at;
        $tutorSchedule->save();

        $transaction->tutor_scheduled_id = $tutorSchedule->id;
        $transaction->save();

        $xenditApiKey = env('XENDIT_API_KEY');
        $external_id = 'CLASS_ORDER_' . $transaction->id;
        $baseurl = env('APP_URL');
        $transaction_id = Crypt::encrypt($transaction->id);
        $invoice_data = [
            'external_id' => $external_id,
            'amount' => $transaction->amount,
            'payer_email' => $user->email,
            'description' => "Class: {$class->name}, Tutor: {$class->tutor->name}, Time: {$class->start_at}",
            'success_redirect_url' => "$baseurl/class-order-invoice-$transaction_id",
        ];

        $response = Http::withBasicAuth($xenditApiKey, '')
            ->post('https://api.xendit.co/v2/invoices', $invoice_data);

        if ($response->successful()) {
            $invoice = $response->json();
            $invoiceUrl = $invoice['invoice_url'];

            return redirect()->away($invoiceUrl);
        } else {
            return redirect()->route('classes.index')->with('error', 'Payment initiation failed.');
        }
    }

    public function studioDetail($id)
    {
        if (!auth()->check()) {
            return redirect()->route('login')->withErrors(['auth' => 'Silakan login untuk mengakses halaman ini.']);
        }

        $studio = Studio::findOrFail($id);

        return view('user.studios.detail', compact('studio'));
    }

    public function orderStudio(Request $request, $id)
    {
        $studio = Studio::findOrFail($id);
        $user = auth()->user();

        $request->validate([
            'booked_at' => 'required|date',
        ]);

        $existingBooking = StudioSchedule::where('studio_id', $studio->id)
            ->where('booked_at', $request->booked_at)
            ->where('status', '!=', 'cancelled')
            ->first();

        if ($existingBooking) {
            return redirect()->route('studios.index')->with('error', 'This studio is already booked for the selected time.');
        }

        $transaction = new Transaction();
        $transaction->user_id = $user->id;
        $transaction->studio_id = $studio->id;
        $transaction->amount = $studio->price;
        $transaction->status = 'pending';
        $transaction->save();

        $studioSchedule = new StudioSchedule();
        $studioSchedule->studio_id = $studio->id;
        $studioSchedule->user_id = $user->id;
        $studioSchedule->booked_at = $request->booked_at;
        $studioSchedule->status = 'pending';
        $studioSchedule->save();

        $transaction->studio_schedule_id = $studioSchedule->id;
        $transaction->save();

        $xenditApiKey = env('XENDIT_API_KEY');
        $external_id = 'STUDIO_ORDER_' . $transaction->id;
        $baseurl = env('APP_URL');
        $transaction_id = Crypt::encrypt($transaction->id);
        $invoice_data = [
            'external_id' => $external_id,
            'amount' => $transaction->amount,
            'payer_email' => $user->email,
            'success_redirect_url' => "$baseurl/studio-order-invoice-$transaction_id",
        ];

        $response = Http::withBasicAuth($xenditApiKey, '')
            ->post('https://api.xendit.co/v2/invoices', $invoice_data);

        if ($response->successful()) {
            $invoice = $response->json();
            $invoiceUrl = $invoice['invoice_url'];

            return redirect()->away($invoiceUrl);
        } else {
            return redirect()->route('studios.index')->with('error', 'Payment initiation failed.');
        }
    }

    public function transactionuser()
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Please log in to view studio details.');
        }

        $user = auth()->user();

        $transactions = Transaction::with(['studio', 'tutor', 'class'])
                                ->where('user_id', $user->id)
                                ->orderBy('created_at', 'desc')
                                ->get();
        
        return view('user.transactions.index', compact('transactions'));
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

        return view('user.transactions.show', compact('transaction', 'events'));
    }

    public function handleClassOrderInvoice($transaction_id)
    {
        try {
            $transactionId = Crypt::decrypt($transaction_id);
            $transaction = Transaction::findOrFail($transactionId);
            
            if ($transaction->status === 'pending') {
                $transaction->amount_paid = $transaction->amount;
                $transaction->status = 'paid';
                $transaction->save();
                
                return redirect()->route('usertransactions.index')->with('success', 'Payment successful! Your class has been booked.');
            } else {
                return redirect()->route('usertransactions.index')->with('error', 'Transaction already processed or invalid.');
            }
        } catch (\Exception $e) {
            return redirect()->route('usertransactions.index')->with('error', 'An error occurred while processing the payment.');
        }
    }

    public function handleStudioOrderInvoice($transaction_id)
    {
        try {
            $transactionId = Crypt::decrypt($transaction_id);
            $transaction = Transaction::findOrFail($transactionId);

            if ($transaction->status === 'pending') {
                $transaction->amount_paid = $transaction->amount;
                $transaction->status = 'paid';
                $transaction->save();

                $transaction->studioSchedule->status = 'confirmed';
                $transaction->studioSchedule->save();

                return redirect()->route('usertransactions.index')->with('success', 'Payment successful! Your studio has been booked.');
            } else {
                return redirect()->route('usertransactions.index')->with('error', 'Transaction already processed or invalid.');
            }
        } catch (\Exception $e) {
            return redirect()->route('usertransactions.index')->with('error', 'An error occurred while processing the payment.');
        }
    }

    public function showRegistrationForm()
    {
        return view('user.auth.register');
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone_number' => ['nullable', 'string', 'max:20'],
            'gender' => ['nullable', 'string', 'in:male,female,other'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = User::create([
            'id' => Str::uuid(),
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'gender' => $request->gender,
            'password' => Hash::make($request->password),
            'role_id'=> 2,
        ]);

        auth()->login($user);

        return redirect()->route('userdashboard')->with('success', 'Registration successful. Welcome to Dance Connect!');
    }

    public function showLinkRequestForm()
    {
        return view('user.auth.forgot');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
                    ? back()->with(['status' => __($status)])
                    : back()->withErrors(['email' => __($status)]);
    }

    public function showResetForm($token)
    {
        return view('user.auth.reset', ['token' => $token]);
    }

    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => bcrypt($password)
                ])->save();
            }
        );

        return $status === Password::PASSWORD_RESET
                    ? redirect()->route('login')->with('status', __($status))
                    : back()->withErrors(['email' => [__($status)]]);
    }

    public function showprofile()
    {
        $user = auth()->user();
        return view('user.profile.show', compact('user'));
    }

    public function edit()
    {
        $user = auth()->user();
        return view('user.profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = auth()->user();
        
        $request->validate([
            'name' => 'required|string|max:255',
            'gender' => 'nullable|string|in:male,female,other',
            'phone_number' => 'nullable|string|max:20',
            'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
        ]);

        $user->update($request->only(['name', 'gender', 'phone_number', 'email']));

        return redirect()->route('profile.show')->with('success', 'Profile updated successfully');
    }
}

