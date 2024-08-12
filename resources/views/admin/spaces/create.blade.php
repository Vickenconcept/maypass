<x-app-layout>
    <div class="container mx-auto px-4  md:w-[70%]">
        <h1 class="text-2xl font-bold mb-4">Create New Space</h1>

        <div class="bg-white rounded-lg shadow-md p-6">
            <form action="{{ route('spaces.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Space Name</label>
                    <input type="text" name="name" id="name"
                        class="form-control2" placeholder="Space Name" required>
                </div>

                <div class="mb-4">
                    <label for="category_id" class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                    <select name="category_id" id="category_id"
                        class="form-control2" required>
                        @forelse ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @empty
                            <option selected disabled> Create New Category</option>
                        @endforelse
                    </select>
                </div>

                <div class="mb-4">
                    <label for="price_per_day" class="block text-sm font-medium text-gray-700 mb-1">Price Per Day</label>
                    <input type="number" name="price_per_day" id="price_per_day"
                        class="form-control2" placeholder="3000" required>
                </div>

                <div class="mb-4">
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-1" >Description</label>
                    <textarea name="description" id="description" placeholder="Say something.." class="form-control2" rows="5"
                        required></textarea>
                </div>

                <div class="mb-4">
                    <input  type="file" class="dropify" name="image" id="image"  required/>
                </div>

                <button type="submit" class="btn-basic">Create Space</button>
            </form>
        </div>
    </div>

    <script>
        $('.dropify').dropify();
    </script>
</x-app-layout>
