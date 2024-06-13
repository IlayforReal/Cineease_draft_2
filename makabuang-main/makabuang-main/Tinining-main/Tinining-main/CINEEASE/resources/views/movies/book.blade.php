<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Book Movie') }}
        </h2>
        <link rel="stylesheet" href="{{ asset('css/dash.css') }}">
        <link rel="stylesheet" href="{{ asset('css/book.css') }}">
    </x-slot>

    <div class="movies-container2">
        <div class="movie-item2">
            <img src="{{ asset('storage/' . $movie->poster) }}" alt="Movie Poster" class="poster">
            <div class="details2">
                <h3 class="title">{{ $movie->title }}</h3>
                <p class="description">{{ $movie->description }}</p>
                <p class="year">Date Released: <span class="font-medium">{{ $movie->date_showing }}</span></p>
            </div>

            <div class="booking-container">
                <form action="{{ route('movies.reserve.seat') }}" method="POST">
                    @csrf
                    <input type="hidden" name="movie_id" value="{{ $movie->id }}">
                    <input type="hidden" name="poster" value="{{ $movie->poster }}">
                    <input type="hidden" name="movie_title" value="{{ $movie->title }}">
                    <div class="table-container">
                        <table>
                            <tr>
                                <td>Theater</td>
                                <td>Performance Art Theater</td>
                            </tr>
                            <tr>
                                <td>Seat Arrangement</td>
                                <td>
                                    <input type="text" id="seatArrangement" name="seatArrangement" style="width: 80%; height: 30px;">
                                </td>
                            </tr>
                            <tr>
                                <td>No. of Seats</td>
                                <td>
                                    <input type="number" id="quantity" name="quantity" min="1" style="width: 80%; height: 30px;" oninput="calculateAmount()">
                                </td>
                            </tr>
                            <tr>
                                <td>Amount</td>
                                <td>
                                    <span id="amount">0</span> pesos
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="button-container">
                        <input type="submit" value="Proceed" class="proceed-button">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function calculateAmount() {
            var quantity = document.getElementById('quantity').value;
            var movieCost = 150; // Assuming movie cost is 150 pesos per seat
            var totalAmount = quantity * movieCost;
            document.getElementById('amount').textContent = totalAmount;
        }
    </script>
</x-app-layout>
