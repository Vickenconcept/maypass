<x-app-layout>
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold mb-4">Manage Payments</h1>
    
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <table class="min-w-full bg-white">
                <thead>
                    <tr>
                        <th class="py-2 px-4 border-b">User</th>
                        <th class="py-2 px-4 border-b">Space</th>
                        <th class="py-2 px-4 border-b">Amount</th>
                        <th class="py-2 px-4 border-b">Payment Method</th>
                        <th class="py-2 px-4 border-b">Payment Date</th>
                        <th class="py-2 px-4 border-b">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($payments as $payment)
                    <tr>
                        <td class="py-2 px-4 border-b">{{ $payment->user->name }}</td>
                        <td class="py-2 px-4 border-b">{{ $payment->space->name }}</td>
                        <td class="py-2 px-4 border-b">${{ $payment->amount }}</td>
                        <td class="py-2 px-4 border-b">{{ ucfirst($payment->payment_method) }}</td>
                        <td class="py-2 px-4 border-b">{{ $payment->created_at->format('d M Y') }}</td>
                        <td class="py-2 px-4 border-b">
                            <a href="{{ route('payments.show', $payment->id) }}" class="text-blue-500 hover:text-blue-700">View</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>