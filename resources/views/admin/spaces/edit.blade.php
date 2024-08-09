<x-app-layout>
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold mb-4">Edit Space</h1>

        <div class="bg-white rounded-lg shadow-md p-6">
            <form action="{{ route('spaces.update', $space->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Space Name</label>
                    <input type="text" name="name" id="name" value="{{ $space->name }}"
                        class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm" required>
                </div>

                <div class="mb-4">
                    <label for="category_id" class="block text-sm font-medium text-gray-700">Category</label>
                    <select name="category_id" id="category_id"
                        class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm" required>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" @if ($space->category_id == $category->id) selected @endif>
                                {{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label for="price_per_day" class="block text-sm font-medium text-gray-700">Price Per Day</label>
                    <input type="number" name="price_per_day" id="price_per_day" value="{{ $space->price_per_day }}"
                        class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm" required>
                </div>

                <div class="mb-4">
                    <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                    <textarea name="description" id="description" class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm"
                        required>{{ $space->description }}</textarea>
                </div>

                <div class="mb-4">
                    <label for="image" class="block text-sm font-medium text-gray-700">Image</label>
                    <input type="file" name="image" id="image"
                        class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm">
                    @if ($space->image_url)
                        <img src="{{ $space->image_url }}" alt="{{ $space->name }}"
                            class="w-32 h-32 object-cover mt-2">
                    @endif
                </div>

                <button type="submit"
                    class="w-full bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">Update Space</button>
            </form>
        </div>
    </div>
</x-app-layout>
