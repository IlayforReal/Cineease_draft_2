<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
        <!-- Link to dash.css -->
        <link rel="stylesheet" href="{{ asset('css/userdash.css') }}">
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2> Movie Lists </h2>

                    <!-- Movies Container -->
                    <div class="movies-container">
                        <!-- Loop through movies -->
                        @foreach ($movies as $movie)
                            <div class="movie-item">
                                <img src="{{ asset('storage/' . $movie->poster) }}" alt="Movie Poster" class="poster">
                                <div class="details">
                                    <h3 class="title">{{ $movie->title }}</h3>
                                    <p class="description">{{ $movie->description }}</p>
                                    <p class="year">Date Released: <span class="font-medium">{{ $movie->date_showing }}</span></p>
                                </div>
                                <a href="{{ route('movies.book', ['id' => $movie->id]) }}" class="book-now-button">Book Now</a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
