<x-app-layout>
    <div class="container mx-auto px-4 ">
        <h2 class="text-2xl font-bold mb-8 mt-10  ">My Bookings</h2>

        @if ($bookings->isEmpty())
            <div
                class="p-20 bg-white  shadow-md rounded-lg overflow-hidden flex items-center justify-center md:col-span-2 lg:col-span-3">
                <h4 class="text-2xl font-bold text-gray-400">No data</h4>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach ($bookings as $booking)
                    {{-- @if ($booking->status == 'confirmed' || $booking->status == 'pending') --}}
                    <div class="bg-white shadow-md rounded-lg overflow-hidden">
                        <div class="p-4">
                            <h3 class="text-xl font-bold">{{ $booking->space->name }}</h3>
                            <p class="text-gray-700">Date: {{ $booking->date }}</p>
                            <p class="text-gray-700">Time: {{ $booking->time }}</p>
                            <p class="text-gray-700">status: {{ $booking->status }}</p>
                            <p class="text-gray-700">Duration: {{ $booking->duration }} hours</p>
                            @if ($booking->status == 'confirmed')
                                <a href="{{ route('my.space.show', $booking->space->id) }}"
                                    class="text-blue-500 hover:underline">View Space</a>
                            @elseif ($booking->status == 'canceled')
                                <span class="text-red-500 font-bold">Cancled</span>
                            @else
                                <span class="text-yellow-500 font-bold">Pending</span>
                            @endif
                        </div>
                    </div>
                    {{-- @else
                        <div
                            class="p-20 bg-white  shadow-md rounded-lg overflow-hidden flex items-center justify-center md:col-span-2 lg:col-span-3">
                            <h4 class="text-2xl font-bold text-gray-400">No data</h4>
                        </div>
                    @endif --}}
                @endforeach
            </div>
        @endif
    </div>
</x-app-layout>
