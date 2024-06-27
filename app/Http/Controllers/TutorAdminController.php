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

    public function indexClasses()
    {
        $classes = Classes::with('tutor')->orderBy('created_at', 'asc')->get();

        return view('admin.tutors.classes.index', compact('classes'));
    }

    public function showClass($id)
    {
        $class = Classes::findOrFail($id);

        return view('admin.tutors.classes.show', compact('class'));
    }
    
    public function createClass()
    {
        $tutors = Tutor::all();
        
        return view('admin.tutors.classes.create', compact('tutors'));
    }
    
    public function storeClass(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'start_at' => 'required|date',
            'quota' => 'required|integer',
            'tutor_id' => 'required|exists:tutors,id',
            'description' => 'nullable|string',
            'duration' => 'required|integer',
            'price' => 'required|numeric|min:10000, max:99999999',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        $class = new Classes();

        $class->name = $request->input('name');
        $class->start_at = $request->input('start_at');
        $class->quota = $request->input('quota');
        $class->tutor_id = $request->input('tutor_id');
        $class->description = $request->input('description');
        $class->duration = $request->input('duration');
        $class->price = $request->input('price');
        
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images/classes', 'public');
            $class->image_url = $imagePath;
        }
        
        $class->save();
    
        return redirect()->route('classes.index')->with('success', 'Kelas berhasil dibuat.');
    }
    
    public function editClass($id)
    {
        $class = Classes::findOrFail($id);

        $tutors = Tutor::all();

        return view('admin.tutors.classes.edit', compact('class', 'tutors'));
    }
    
    public function updateClass(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'start_at' => 'required|date',
            'quota' => 'required|integer',
            'tutor_id' => 'required|exists:tutors,id',
            'description' => 'nullable|string',
            'duration' => 'required|integer',
            'price' => 'required|numeric|min:10000, max:99999999',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        $class = Classes::findOrFail($id);

        $class->name = $request->input('name');
        $class->start_at = $request->input('start_at');
        $class->quota = $request->input('quota');
        $class->tutor_id = $request->input('tutor_id');
        $class->description = $request->input('description');
        $class->duration = $request->input('duration');
        $class->price = $request->input('price');
        
        if ($request->hasFile('image')) {
            if ($class->image_url) {
                Storage::disk('public')->delete($class->image_url);
            }
            $imagePath = $request->file('image')->store('images/classes', 'public');
            $class->image_url = $imagePath;
        }
        
        $class->save();
        
    
        return redirect()->route('classes.index')->with('success', 'Kelas berhasil diperbarui.');
    }

    public function destroyClass($id)
    {
        $class = Classes::findOrFail($id);
        if ($class->image_url) {
            Storage::disk('public')->delete($class->image_url);
        }
        $class->delete();

        return redirect()->route('classes.index')->with('success', 'Kelas berhasil dihapus.');
    }

    public function getTutorInfo($id)
    {
        $tutor = Tutor::findOrFail($id);

        return response()->json([
            'name' => $tutor->name,
            'image_url' => asset('storage/' . $tutor->image_url),
            'bio' => $tutor->bio
        ]);
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