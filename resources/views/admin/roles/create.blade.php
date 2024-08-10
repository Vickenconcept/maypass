<x-app-layout>
        <div class=" mx-auto px-6 py-8 md:w-[50%] shadow rounded-xl bg-white mt-20">
            <div class="mb-4">
                <a href="{{ route('roles.index') }}"  class="flex items-center font-semibold hover:text-[#25a0db]">
                  <i class='bx bx-chevron-left text-xl mt-1 '></i><span>Back</span>
                </a>
            </div>
            <h1 class="text-2xl font-bold mb-4">Create a New Role</h1>
        
        
            <form action="{{ route('roles.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="name" class="block text-gray-700 font-semibold">Role Name</label>
                    <input type="text" name="name" id="name" class="mt-1 p-2 block w-full border focus:outline-none focus:ring-[#25a0db] focus:border-[#25a0db] border-2 border-gray-200 rounded-md @error('name') border-red-500 @enderror" value="{{ old('name') }}" required placeholder="Role Name eg: staff">
                    @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
        
                <div class="mb-4">
                    <button type="submit" class="btn-primary">Create Role</button>
                </div>
            </form>
        </div>
</x-app-layout>