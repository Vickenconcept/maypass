<x-app-layout>
    <div class="container mx-auto px-4 ">
        <h2 class="text-2xl font-bold mb-8 mt-10  ">My Bookings</h2>

        @if ($bookings->isEmpty())
            <div
                class="p-20 bg-white  shadow-md rounded-lg overflow-hidden flex items-center justify-center md:col-span-2 lg:col-span-3">
                <img src="{{ asset('images/empty.svg') }}" alt="">
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach ($bookings as $booking)
                    {{-- @if ($booking->status == 'confirmed' || $booking->status == 'pending') --}}
                    <div class="bg-white shadow-md rounded-lg overflow-hidden">
                        <div class="p-4">
                            <h3 class="text-xl font-bold uppercase">{{ $booking->space->name }}</h3>
                            <p class="text-gray-700 font-medium">
                                <span class="text-[#25a0db] font-bold">
                                    Date:
                                </span>
                                {{ $booking->created_at->format('d M Y') }}
                            </p>

                            <p class="text-gray-700 font-medium">
                                <span class="text-[#25a0db] font-bold">
                                    status:
                                </span>

                                @if ($booking->status == 'confirmed')
                                    <span
                                        class="border border-green-600 bg-green-100 text-green-600 px-3 py-0.5 rounded-full font-semibold text-xs ">
                                        Completed</span>
                                @elseif($booking->status == 'canceled')
                                    <span
                                        class="border border-red-600 bg-red-100 text-red-600 px-3 py-0.5 rounded-full font-semibold text-xs ">
                                        Failed</span>
                                @elseif($booking->status == 'ended')
                                    <span
                                        class="border border-gray-600 bg-gray-100 text-gray-600 px-3 py-0.5 rounded-full font-semibold text-xs ">
                                        Ended</span>
                                @else
                                    <span
                                        class="border border-yellow-600 bg-yellow-100 text-yellow-600 px-3 py-0.5 rounded-full font-semibold text-xs ">
                                        Pending</span>
                                @endif
                            </p>
                            <p class="text-gray-700 font-medium">
                                <span class="text-[#25a0db] font-bold">
                                    Duration:
                                </span>
                                {{ $booking->days_count }} days
                            </p>

                            <p class="text-gray-700 font-medium">
                                <span class="text-[#25a0db] font-bold">
                                    Expires:
                                </span>
                                {{ \Carbon\Carbon::parse($booking->date_to_activate)->format('F j, Y') }}
                            </p>


                            <div class="mt-3">
                                @if ($booking->status == 'confirmed')
                                    <a href="{{ route('my.space.show', $booking->space->id) }}"
                                        class="text-blue-500 hover:underline font-medium flex items-center space-x-1"><span>View Space</span> <i class='bx bx-show-alt mt-1' ></i></a>
                                @elseif ($booking->status == 'canceled')
                                    <span class="text-red-500 font-bold">Cancled</span>
                                @else
                                    <span class="text-yellow-500 font-bold">Pending</span>
                                @endif
                            </div>
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
