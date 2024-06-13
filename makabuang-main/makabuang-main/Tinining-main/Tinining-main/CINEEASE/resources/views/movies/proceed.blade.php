<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Proceed with Booking') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <div class="mt-8 text-2xl">
                        Movie Title: {{ $booking['movie_title'] }}
                    </div>

                    <!-- Display other booking details -->
                    <div class="mt-6">
                        <dl>
                            <dt class="text-lg leading-7 font-semibold text-gray-900">
                                Poster:
                            </dt>
                            <dd class="mt-1 text-base text-gray-700">
                                <img src="{{ asset('storage/' . $booking['poster']) }}" alt="Movie Poster" class="w-32 h-auto">
                            </dd>
                        </dl>
                    </div>

                    <!-- Display other booking details like date booked, seats, total amount -->
                    <div class="mt-6">
                        <dl>
                            <dt class="text-lg leading-7 font-semibold text-gray-900">
                                Date Booked:
                            </dt>
                            <dd class="mt-1 text-base text-gray-700">
                                {{ now()->format('Y-m-d') }}
                            </dd>
                        </dl>
                    </div>

                    <!-- Include a form for payment method and confirmation -->
                    <form action="{{ route('confirm.booking') }}" method="POST">
                        @csrf
                        <div class="mt-6">
                            <label for="payment_method" class="block text-sm font-medium text-gray-700">Payment Method</label>
                            <select id="payment_method" name="payment_method" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                <option value="credit_card">Credit Card</option>
                                <option value="debit_card">Debit Card</option>
                                <option value="paypal">PayPal</option>
                            </select>
                        </div>

                        <div class="mt-6">
                            <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Confirm Booking
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
