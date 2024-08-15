<x-app-layout>
    <div class="container mx-auto px-4">
        <h2 class="text-2xl font-bold mb-8  border-y  border-gray-500 py-3 ">My Bookings</h2>

        {{-- @if ($bookings->isEmpty())
            <div
                class="p-20 bg-white  shadow-md rounded-lg overflow-hidden flex items-center justify-center md:col-span-2 lg:col-span-3">
                <img src="{{ asset('images/empty.svg') }}" alt="">
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach ($bookings as $booking)
                    <div class="bg-white shadow-md rounded-lg overflow-hidden">
                        <div class="p-4">
                            <h3 class="text-xl font-bold uppercase">{{ $booking->space->name }}</h3>
                            <p class="text-gray-700 font-medium">
                                <span class="text-[#b30000] font-bold">
                                    Date:
                                </span>
                                {{ $booking->created_at->format('d M Y') }}
                            </p>

                            <p class="text-gray-700 font-medium">
                                <span class="text-[#b30000] font-bold">
                                    Status:
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
                                <span class="text-[#b30000] font-bold">
                                    Duration:
                                </span>
                                {{ $booking->days_count }} days
                            </p>

                            <p class="text-gray-700 font-medium">
                                <span class="text-[#b30000] font-bold">
                                    Expires:
                                </span>
                                {{ \Carbon\Carbon::parse($booking->date_to_activate)->format('F j, Y') }}
                            </p>


                            <div class="mt-3">
                                @if ($booking->status == 'confirmed')
                                    <a href="{{ route('my.space.show', $booking->space->id) }}"
                                        class="text-blue-500 hover:underline font-medium flex items-center space-x-1"><span>View
                                            Space</span> <i class='bx bx-show-alt mt-1'></i></a>
                                @elseif ($booking->status == 'canceled')
                                    <span class="text-red-500 font-bold">Cancled</span>
                                @else
                                    <span class="text-yellow-500 font-bold">Pending</span>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif --}}

        @if ($workspaces->isEmpty())
            <div
                class="p-20 bg-white  shadow-md rounded-lg overflow-hidden flex items-center justify-center md:col-span-2 lg:col-span-3">
                <img src="{{ asset('images/empty.svg') }}" alt="">
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach ($workspaces as $space)
                    <div class="bg-white shadow-md rounded-lg overflow-hidden">
                        <div class="p-4">
                            <h3 class="text-xl font-bold uppercase">{{ $space->name }}</h3>
                            <div
                                class="bg-gray-200 rounded-md overflow-hidden group h-[200px]  transition-all duration-700 relative">
                                <div
                                    class=" font-bold absolute transition-all duration-700 block w-full h-full bg-gray-500">
                                    @if ($space->image)
                                        <img src="{{ asset('storage/' . $space->image) }}" alt="{{ $space->name }}"
                                            class="w-full object-cover rounded-lg">
                                    @else
                                        <img src="{{ asset('images/workspace.jpg') }}" alt="{{ $space->name }}"
                                            class="w-full object-cover rounded-lg">
                                    @endif
                                </div>
                                <div
                                    class="w-full bg-[#b30000] bg-opacity-10 group-hover:text-white  h-full relative -translate-x-full group-hover:translate-x-0 transition-all duration-700">
                                    <div class=" z-10  h-full flex items-center justify-center">
                                        <div class="text-center">
                                            {{-- <p class="text-md font-bold capitalize">
                                                <a href="{{ route('my.space.show', $space->id) }}"
                                                    class=" btn-primary2">
                                                    <span>View Space</span>
                                                    <i class='bx bx-show-alt mt-1'></i>
                                                </a>
                                            </p> --}}
                                        </div>

                                    </div>
                                </div>
                            </div>
                            {{-- <div class="mt-3">
                                <a href="{{ route('my.space.show', $space->id) }}"
                                    class="text-blue-500 hover:underline font-medium flex items-center space-x-1"><span>View
                                        Space</span> <i class='bx bx-show-alt mt-1'></i></a>

                            </div> --}}
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>



</x-app-layout>
