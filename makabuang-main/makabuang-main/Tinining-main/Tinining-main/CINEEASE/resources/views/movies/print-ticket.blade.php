<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Print Ticket') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <div class="mt-8 text-2xl">
                        Movie Title: {{ $booking['movie_title'] ?? 'N/A' }}
                    </div>

                    <!-- Display other ticket details -->
                    <div class="mt-6">
                        <dl>
                            <dt class="text-lg leading-7 font-semibold text-gray-900">
                                Poster:
                            </dt>
                            <dd class="mt-1 text-base text-gray-700">
                                <img src="{{ asset('storage/' . ($booking['poster'] ?? '')) }}" alt="Movie Poster" class="w-32 h-auto">
                            </dd>
                        </dl>
                    </div>

                    <!-- Display other ticket details like ticket ID, user name, email, reserved seats, etc. -->
                    <div class="mt-6">
                        <dl>
                            <dt class="text-lg leading-7 font-semibold text-gray-900">
                                Ticket ID:
                            </dt>
                            <dd class="mt-1 text-base text-gray-700">
                                666b7af43804f <!-- Replace with your actual Ticket ID generation logic or retrieved value -->
                            </dd>
                            <dt class="text-lg leading-7 font-semibold text-gray-900">
                                User Name:
                            </dt>
                            <dd class="mt-1 text-base text-gray-700">
                                {{ auth()->user()->name ?? 'N/A' }}
                            </dd>
                            <dt class="text-lg leading-7 font-semibold text-gray-900">
                                Email:
                            </dt>
                            <dd class="mt-1 text-base text-gray-700">
                                {{ auth()->user()->email ?? 'N/A' }}
                            </dd>
                            <dt class="text-lg leading-7 font-semibold text-gray-900">
                                Reserved Seats:
                            </dt>
                            <dd class="mt-1 text-base text-gray-700">
                                {{ $booking['quantity'] ?? 'N/A' }}
                            </dd>
                            <dt class="text-lg leading-7 font-semibold text-gray-900">
                                Total Amount:
                            </dt>
                            <dd class="mt-1 text-base text-gray-700">
                                {{ $booking['total_amount'] ?? 'N/A' }} pesos
                            </dd>
                        </dl>
                    </div>

                    <!-- Include a button to save the ticket if needed -->
                    <div class="mt-6">
                        <button type="button" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Save Ticket
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
