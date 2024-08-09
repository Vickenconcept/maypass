<x-app-layout>
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold mb-4">Create a New Role</h1>
    
    
        <form action="{{ route('roles.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="name" class="block text-gray-700">Role Name</label>
                <input type="text" name="name" id="name" class="mt-1 p-2 block w-full border border-gray-300 rounded-md @error('name') border-red-500 @enderror" value="{{ old('name') }}" required>
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
    
            <div class="mb-4">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">Create Role</button>
            </div>
        </form>
    </div>
</x-app-layout>