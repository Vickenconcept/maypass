<x-app-layout>
    <div class="container mx-auto px-4 ">
        <h1 class="text-2xl font-bold mb-4">Edit Category</h1>
    
        <div class="bg-white rounded-lg shadow-md p-6 md:w-[70%] mx-auto">
            <form action="{{ route('categories.update', $category->id) }}" method="POST">
                @csrf
                @method('PUT')
    
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Category Name</label>
                    <input type="text" name="name" id="name" value="{{ $category->name }}" class="form-control2" required>
                </div>
    
                <div class="mb-4">
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                    <textarea name="description" id="description" class="form-control2" rows="5"  required>{{ $category->description }}</textarea>
                </div>
    
                <button type="submit" class="btn-basic">Update Category</button>
            </form>
        </div>
    </div>
</x-app-layout>