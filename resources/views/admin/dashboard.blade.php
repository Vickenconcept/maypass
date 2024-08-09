<x-app-layout>
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold mb-4">Admin Dashboard</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <div class="bg-white rounded-lg shadow-md p-4">
                <h2 class="text-lg font-bold">Manage Spaces</h2>
                <p class="text-gray-600">View and manage cowork spaces.</p>
                <a href="{{ route('spaces.index') }}"
                    class="mt-4 inline-block bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">Go to
                    Spaces</a>
            </div>

            <div class="bg-white rounded-lg shadow-md p-4">
                <h2 class="text-lg font-bold">Manage Categories</h2>
                <p class="text-gray-600">View and manage space categories.</p>
                <a href="{{ route('categories.index') }}"
                    class="mt-4 inline-block bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">Go to
                    Categories</a>
            </div>

            <div class="bg-white rounded-lg shadow-md p-4">
                <h2 class="text-lg font-bold">View Bookings</h2>
                <p class="text-gray-600">View and manage space bookings.</p>
                <a href="{{ route('bookings.index') }}"
                    class="mt-4 inline-block bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">Go to
                    Bookings</a>
            </div>

            <div class="bg-white rounded-lg shadow-md p-4">
                <h2 class="text-lg font-bold">View Payments</h2>
                <p class="text-gray-600">View payment details.</p>
                <a href="{{ route('payments.index') }}"
                    class="mt-4 inline-block bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">Go to
                    Payments</a>
            </div>

            <div class="bg-white rounded-lg shadow-md p-4">
                <h2 class="text-lg font-bold">Manage Users</h2>
                <p class="text-gray-600">View and manage system users.</p>
                <a href="{{ route('users.index') }}"
                    class="mt-4 inline-block bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">Go to
                    Users</a>
            </div>
        </div>
    </div>
</x-app-layout>
