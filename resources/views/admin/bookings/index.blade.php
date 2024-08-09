<x-app-layout>
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold mb-4">Manage Bookings</h1>
    
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <table class="min-w-full bg-white">
                <thead>
                    <tr>
                        <th class="py-2 px-4 border-b">Space</th>
                        <th class="py-2 px-4 border-b">User</th>
                        <th class="py-2 px-4 border-b">Days</th>
                        <th class="py-2 px-4 border-b">Total Amount</th>
                        <th class="py-2 px-4 border-b">Booking Date</th>
                        <th class="py-2 px-4 border-b">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($bookings as $booking)
                    <tr>
                        <td class="py-2 px-4 border-b">{{ $booking->space->name }}</td>
                        <td class="py-2 px-4 border-b">{{ $booking->user->name }}</td>
                        <td class="py-2 px-4 border-b">{{ $booking->days }}</td>
                        <td class="py-2 px-4 border-b">${{ $booking->total_amount }}</td>
                        <td class="py-2 px-4 border-b">{{ $booking->created_at->format('d M Y') }}</td>
                        <td class="py-2 px-4 border-b">
                            <a href="{{ route('bookings.show', $booking->id) }}" class="text-blue-500 hover:text-blue-700">View</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>