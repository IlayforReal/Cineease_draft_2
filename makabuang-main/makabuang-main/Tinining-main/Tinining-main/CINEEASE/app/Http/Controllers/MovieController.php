<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use Illuminate\Support\Facades\Log;

class MovieController extends Controller
{
    public function index()
{
    $movies = Movie::all();
    return view('movies.index', compact('movies'));
}
    public function create()
    {
        return view('admin.movies.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'poster' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'required|string',
            'date_showing' => 'required|date',
            'amount' => 'required|numeric',
            'seats_available' => 'required|integer',
        ]);
        
        Log::info('Seats Available: ' . $validatedData['seats_available']);

        $posterPath = $request->file('poster')->store('posters', 'public');

        $movie = new Movie([
            'title' => $validatedData['title'],
            'poster' => $posterPath,
            'description' => $validatedData['description'],
            'date_showing' => $validatedData['date_showing'],
            'amount' => $validatedData['amount'],
            'seats_available' => $validatedData['seats_available'],
        ]);
        $movie->save();

        return redirect()->route('admin.dashboard')->with('success', 'Movie added successfully.');
    }

    public function edit(Movie $movie)
    {
        return view('admin.movies.edit', compact('movie'));
    }

    public function update(Request $request, Movie $movie)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'poster' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'required|string',
            'date_showing' => 'required|date',
            'amount' => 'required|numeric',
            'seats_available' => 'required|integer',
        ]);

        Log::info('Seats Available: ' . $validatedData['seats_available']);

        if ($request->hasFile('poster')) {
            $posterPath = $request->file('poster')->store('posters', 'public');
            $movie->poster = $posterPath;
        }

        $movie->title = $validatedData['title'];
        $movie->description = $validatedData['description'];
        $movie->date_showing = $validatedData['date_showing'];
        $movie->amount = $validatedData['amount'];
        $movie->seats_available = $validatedData['seats_available'];
        $movie->save();

        return redirect()->route('admin.dashboard')->with('success', 'Movie updated successfully.');
    }
}
