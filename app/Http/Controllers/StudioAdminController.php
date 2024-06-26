<?php

namespace App\Http\Controllers;

use App\Models\Studio;
use App\Models\StudioSchedule;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class StudioAdminController extends Controller
{
    public function index()
    {
        $studios = Studio::orderBy('created_at', 'asc')->get();

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

    public function show($id)
    {
        $studio = Studio::findOrFail($id);
        
        return view('admin.studios.show', compact('studio'));
    }

    public function create()
    {
        return view('admin.studios.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'price' => 'required|numeric|min:10000',
            'owner' => 'required|string|max:255',
            'description' => 'nullable|string'
        ]);

        $imagePath = $request->file('image')->store('images/studios', 'public');

        $studio = new Studio();
        $studio->name = $request->input('name');
        $studio->location = $request->input('location');
        $studio->image_url = $imagePath;
        $studio->price = $request->input('price');
        $studio->owner = $request->input('owner');
        $studio->description = $request->input('description');
        $studio->save();

        return redirect()->route('studios.index')->with('success', 'Studio created successfully.');
    }

    public function edit($id)
    {
        $studio = Studio::findOrFail($id);

        return view('admin.studios.edit', compact('studio'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'price' => 'required|numeric|min:10000',
            'owner' => 'required|string|max:255',
            'description' => 'nullable|string'
        ]);

        $studio = Studio::findOrFail($id);

        $studio->name = $request->input('name');
        $studio->location = $request->input('location');
        $studio->price = $request->input('price');
        $studio->owner = $request->input('owner');
        $studio->description = $request->input('description');
        
        if ($request->hasFile('image')) {
            if ($studio->image_url) {
                Storage::disk('public')->delete($studio->image_url);
            }
            
            $imagePath = $request->file('image')->store('images/studios', 'public');
            $studio->image_url = $imagePath;
        }
        
        $studio->save();
        

        return redirect()->route('studios.index')->with('success', 'Studio updated successfully.');
    }

    public function destroy($id)
    {
        $studio = Studio::findOrFail($id);
        if ($studio->image_url) {
            Storage::disk('public')->delete($studio->image_url);
        }
        $studio->delete();

        return redirect()->route('studios.index')->with('success', 'Studio deleted successfully.');
    }
}