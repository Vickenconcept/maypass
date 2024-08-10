<x-app-layout>
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold mb-4">Booking Confirmation</h1>
    
        <div class="bg-[#25a0db] rounded-lg shadow-md p-6 md:w-[50%]">
            <h2 class="text-lg font-bold text-white">Thank you for your booking!</h2>
            <p class="text-white mt-4"><span class="font-bold">Work Space: </span> <span class="capitalize">{{ $booking->space->name }}</span></p>
            <p class="text-white"><span class="font-bold">Days: </span> {{ $booking->days_count }}</p>
            <p class="text-white"><span class="font-bold">Total:</span> #{{ $booking->total_amount }}</p>
            <p class="text-white"><span  class="font-bold">Ending: </span> {{ \Carbon\Carbon::parse($booking->date_to_activate)->format('F j, Y') }}</p>
        </div>
    </div>
</x-app-layout>