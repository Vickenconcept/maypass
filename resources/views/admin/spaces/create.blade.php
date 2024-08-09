<x-app-layout>
    <div class="container mx-auto px-4 py-8 md:w-[60%]">
        <h1 class="text-2xl font-bold mb-4">Create New Space</h1>

        <div class="bg-white rounded-lg shadow-md p-6">
            <form action="{{ route('spaces.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Space Name</label>
                    <input type="text" name="name" id="name"
                        class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm" required>
                </div>

                <div class="mb-4">
                    <label for="category_id" class="block text-sm font-medium text-gray-700">Category</label>
                    <select name="category_id" id="category_id"
                        class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm" required>
                        @forelse ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @empty
                            <option selected disabled> Create New Category</option>
                            
                        @endforelse
                    </select>
                </div>

                <div class="mb-4">
                    <label for="price_per_day" class="block text-sm font-medium text-gray-700">Price Per Day</label>
                    <input type="number" name="price_per_day" id="price_per_day"
                        class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm" required>
                </div>

                <div class="mb-4">
                    <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                    <textarea name="description" id="description" class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm"
                        required></textarea>
                </div>

                <div class="mb-4">
                    <label for="image" class="block text-sm font-medium text-gray-700">Image</label>
                    <input type="file" name="image" id="image"
                        class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm" required>
                </div>

                <button type="submit"
                    class="btn-basic">Create Space</button>
            </form>
        </div>
    </div>
</x-app-layout>
