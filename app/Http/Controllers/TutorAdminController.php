<?php

namespace App\Http\Controllers;

use App\Models\Tutor;
use App\Models\Classes;
use App\Models\Transaction;
use App\Models\TutorSchedule;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class TutorAdminController extends Controller
{
    public function index()
    {
        $tutors = Tutor::orderBy('created_at', 'asc')->get();

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

    public function show($id)
    {
        $tutor = Tutor::findOrFail($id);

        return view('admin.tutors.show', compact('tutor'));
    }

    public function create()
    {
        return view('admin.tutors.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'bio' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $tutor = new Tutor();
        $tutor->name = $request->input('name');
        $tutor->bio = $request->input('bio');

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images/tutors', 'public');
            $tutor->image_url = $imagePath;
        }

        $tutor->save();

        return redirect()->route('tutors.index')->with('success', 'Tutor created successfully.');
    }

    public function edit($id)
    {
        $tutor = Tutor::findOrFail($id);
        
        return view('admin.tutors.edit', compact('tutor'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'bio' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $tutor = Tutor::findOrFail($id);
        $tutor->name = $request->input('name');
        $tutor->bio = $request->input('bio');

        if ($request->hasFile('image')) {
            if ($tutor->image_url) {
                Storage::disk('public')->delete($tutor->image_url);
            }
            
            $imagePath = $request->file('image')->store('images/tutors', 'public');
            $tutor->image_url = $imagePath;
        }

        $tutor->save();

        return redirect()->route('tutors.index')->with('success', 'Tutor updated successfully.');
    }

    public function destroy($id)
    {
        $tutor = Tutor::findOrFail($id);
        if ($tutor->image_url) {
            Storage::disk('public')->delete($tutor->image_url);
        }
        $tutor->delete();

        return redirect()->route('tutors.index')->with('success', 'Tutor deleted successfully.');
    }
}