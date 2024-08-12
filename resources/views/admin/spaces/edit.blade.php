<x-app-layout>
    <div class="container mx-auto px-4  md:w-[70%]">
        <h1 class="text-2xl font-bold mb-4">Edit Space</h1>

        <div class="bg-white rounded-lg shadow-md p-6">
            <form action="{{ route('spaces.update', $space->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="name" class=" mb-1  block text-sm font-medium text-gray-700">Space Name</label>
                    <input type="text" name="name" id="name" value="{{ $space->name }}" placeholder="Space Name" class="form-control2"
                        required>
                </div>

                <div class="mb-4">
                    <label for="category_id" class="mb-1 block text-sm font-medium text-gray-700">Category</label>
                    <select name="category_id" id="category_id" class="form-control2" required>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" @if ($space->category_id == $category->id) selected @endif>
                                {{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label for="price_per_day" class="mb-1 block text-sm font-medium text-gray-700">Price Per Day</label>
                    <input type="number" name="price_per_day" id="price_per_day" value="{{ $space->price_per_day }}"
                        class="form-control2" placeholder="3000" required>
                </div>

                <div class="mb-4">
                    <label for="description" class="mb-1 block text-sm font-medium text-gray-700">Description</label>
                    <textarea name="description" id="description" placeholder="Say something..." class="form-control2" required>{{ $space->description }}</textarea>
                </div>

                <div class="mb-4">
                    <label for="image" class="mb-1 block text-sm font-medium text-gray-700">Image</label>
                    @if (isset($space->image))
                        <input type="file" name="image" class="dropify img-fluid"
                            data-default-file="{{ asset('storage/' . $space->image) }}"
                            id="image">
                    @else
                        <input type="file" class="dropify" name="image" id="image"  required/>
                    @endif

                    
                </div>

                <button type="submit"
                    class="w-full bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">Update Space</button>
            </form>
        </div>
    </div>
    <script>
        $('.dropify').dropify();
    </script>
</x-app-layout>
