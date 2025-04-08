<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event; // Tambahkan impor model

class EventController extends Controller
{
    // Hanya tampilkan view jadwal jika pengguna sudah login
    public function index()
    {
        return view('jadwal_anggota');
    }

    public function getEvents(Request $request)
    {
        $request->validate([
            'date' => 'required|date_format:Y-m-d'
        ]);

        $events = Event::with('user') // Eager load user
            ->where('date', $request->date)
            ->where(function($query) {
                $query->where('visibility', 'public')
                    ->orWhere(function($q) {
                        $q->where('visibility', 'private')
                            ->where('user_id', auth()->id());
                    });
            })
            ->get();

        return response()->json($events);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'      => 'required|max:255',
            'date'       => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'end_time'   => 'required|date_format:H:i|after:start_time',
            'visibility' => 'sometimes|in:public,private'
        ]);

        $event = Event::create([
            'title'      => $request->title,
            'date'       => $request->date,
            'start_time' => $request->start_time,
            'end_time'   => $request->end_time,
            'visibility' => auth()->user()->role === 'admin'
                            ? $request->visibility
                            : 'private',
            'user_id'    => auth()->id()
        ]);

        return response()->json(['success' => true]);
    }
}
