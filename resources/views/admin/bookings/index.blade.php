<x-app-layout>
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold mb-4">Manage Bookings</h1>

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 ">
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
                            <td class="px-6 py-4 capitalize text-center">
                                @if ($booking->status == 'confirmed')
                                    <span
                                        class="border border-green-600 bg-green-100 text-green-600 px-4 py-1 rounded-full font-semibold text-xs ">
                                        Completed</span>
                                @elseif($booking->status == 'canceled')
                                    <span
                                        class="border border-red-600 bg-red-100 text-red-600 px-4 py-1 rounded-full font-semibold text-xs ">
                                        Failed</span>
                                @else
                                    <span
                                        class="border border-yellow-600 bg-yellow-100 text-yellow-600 px-4 py-1 rounded-full font-semibold text-xs ">
                                        Pending</span>
                                @endif
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
    </div>
</x-app-layout>
