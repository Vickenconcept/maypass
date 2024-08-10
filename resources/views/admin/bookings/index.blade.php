<x-app-layout>
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold mb-4">Manage Bookings</h1>

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 shadow-md sm:rounded-lg">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 ">
                    <tr>
                        <th scope="col" class="px-6 py-3">Space</th>
                        <th scope="col" class="px-6 py-3">User</th>
                        <th scope="col" class="px-6 py-3">Days</th>
                        <th scope="col" class="px-6 py-3">Total Amount</th>
                        <th scope="col" class="px-6 py-3">Booking Date</th>
                        <th scope="col" class="px-6 py-3 text-center">Status</th>
                        <th scope="col" class="pr-6 pl-1.5 py-4 text-center">

                        </th>

                    </tr>
                </thead>
                <tbody>
                    @forelse ($bookings as $booking)
                        <tr class="bg-white border-b  hover:bg-gray-50 ">

                            <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap capitalize">
                                {{ $booking->space->name }}</td>
                            <td class="px-6 py-4 capitalize">{{ $booking->user->name }}</td>
                            <td class="px-6 py-4 capitalize">{{ $booking->days_count }}</td>
                            <td class="px-6 py-4 capitalize">${{ $booking->total_amount }}</td>
                            <td class="px-6 py-4 capitalize">{{ $booking->created_at->format('d M Y') }}</td>
                            <td class="px-6 py-4 capitalize flex items-center justify-between space-x-2"
                                id="booking-status-{{ $booking->id }}">
                                @if ($booking->status == 'confirmed')
                                    <span
                                        class="border border-green-600 bg-green-100 text-green-600 px-4 py-1 rounded-full font-semibold text-xs ">
                                        Completed</span>
                                @elseif($booking->status == 'canceled')
                                    <span
                                        class="border border-red-600 bg-red-100 text-red-600 px-4 py-1 rounded-full font-semibold text-xs ">
                                        Failed</span>
                                @elseif($booking->status == 'ended')
                                    <span
                                        class="border border-gray-600 bg-gray-100 text-gray-600 px-4 py-1 rounded-full font-semibold text-xs ">
                                        Ended</span>
                                @else
                                    <span
                                        class="border border-yellow-600 bg-yellow-100 text-yellow-600 px-4 py-1 rounded-full font-semibold text-xs ">
                                        Pending</span>
                                @endif

                                @if ($booking->status == 'canceled' || $booking->status == 'pending')
                                    <button id="dropdownDefaultButton"
                                        data-dropdown-toggle="dropdown_{{ $booking->id }}"
                                        data-dropdown-placement="left" class="" type="button">
                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                            fill="currentColor" viewBox="0 0 4 15">
                                            <path
                                                d="M3.5 1.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 6.041a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 5.959a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z" />
                                        </svg>
                                    </button>
                                @endif

                                <!-- Dropdown menu -->
                                <div id="dropdown_{{ $booking->id }}"
                                    class="z-50 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 ">
                                    <ul class="py-2 text-sm" aria-labelledby="dropdownDefaultButton">
                                        <li>
                                            <a href="#" class="block px-4 py-2 hover:bg-gray-100 "><button
                                                    onclick="updateBookingStatus({{ $booking->id }}, 'confirmed')">Mark
                                                    as
                                                    Confirmed</button>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="#" class="block px-4 py-2 hover:bg-gray-100 "><button
                                                    onclick="updateBookingStatus({{ $booking->id }}, 'canceled')">Mark
                                                    as
                                                    Canceled</button>
                                            </a>
                                        </li>
                                    </ul>
                                </div>

                                {{-- <button onclick="updateBookingStatus({{ $booking->id }}, 'confirmed')">Mark as
                                    Confirmed</button>
                                <button onclick="updateBookingStatus({{ $booking->id }}, 'canceled')">Mark as
                                    Canceled</button>
                                <button onclick="updateBookingStatus({{ $booking->id }}, 'pending')">Mark as
                                    Pending</button> --}}

                            </td>
                            <td class="px-6 py-4 capitalize">
                                <a href="{{ route('bookings.show', $booking->id) }}"
                                    class="text-blue-500 hover:text-blue-700">View</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6"
                                class="bg-white border-b  hover:bg-gray-50 text-center p-8 font-bold text-xl text-gray-400">
                                No data yet
                            </td>
                        </tr>
                    @endforelse

                </tbody>
            </table>
        </div>
        <div class=" my-3">
            {{ $bookings->links() }}
        </div>
    </div>

    <script>
        function updateBookingStatus(bookingId, newStatus) {
            axios.post('/booking/' + bookingId + '/status', {
                    status: newStatus
                })
                .then(response => {
                    document.getElementById('booking-status-' + bookingId).innerHTML = response.data.html;
                    location.reload();
                })
                .catch(error => {
                    console.error('Error updating status:', error);
                });
        }
    </script>
</x-app-layout>
