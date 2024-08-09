<x-app-layout>
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold mb-4">Create New Category</h1>
    
        <div class="bg-white rounded-lg shadow-md p-6">
            <form action="{{ route('categories.store') }}" method="POST">
                @csrf
    
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Category Name</label>
                    <input type="text" name="name" id="name" class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm" required>
                </div>
    
                <div class="mb-4">
                    <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                    <textarea name="description" id="description" class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm" required></textarea>
                </div>
    
                <button type="submit" class="w-full bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">Create Category</button>
            </form>
        </div>
    </div>
</x-app-layout>
