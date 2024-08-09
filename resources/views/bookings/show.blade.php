<x-app-layout>
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold mb-4">Booking Confirmation</h1>
    
        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-lg font-bold">Thank you for your booking!</h2>
            <p class="text-gray-600 mt-4">Space: {{ $booking->space->name }}</p>
            <p class="text-gray-600">Days: {{ $booking->days }}</p>
            <p class="text-gray-600">Total: ${{ $booking->total_amount }}</p>
        </div>
    </div>
</x-app-layout>