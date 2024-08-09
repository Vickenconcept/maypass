<x-app-layout>
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold mb-4">Manage Spaces</h1>

        <div class="flex justify-end mb-4">
            <a href="{{ route('spaces.create') }}"
                class="btn-primary">Create New Space</a>
        </div>


        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 ">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 ">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Image
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Name
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Price Per Day
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Category
                        </th>
                        <th scope="col" class="pr-1.5 pl-6 py-4 text-center">

                        </th>
                        <th scope="col" class="pr-6 pl-1.5 py-4 text-center">

                        </th>

                    </tr>
                </thead>
                <tbody>
                    @forelse ($spaces as $space)
                        <tr class="bg-white border-b  hover:bg-gray-50 ">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap capitalize">
                                <img src="{{ asset('storage/' . $space->image) }}" alt="{{ $space->name }}"
                                    class="w-10 h-10 object-cover rounded">
                            </th>
                            <td class="px-6 py-4 capitalize">
                                {{ $space->name }}
                            </td>
                            <td class="px-6 py-4 capitalize">
                                ${{ $space->price_per_day }}
                            </td>
                            <td class="px-6 py-4 capitalize">
                                {{ $space->category->name }}
                            </td>
                            <td class="pr-1.5 pl-6 py-4 text-center">
                                <a href="{{ route('spaces.edit', $space->id) }}" class="btn-primary2">Edit</a>
                            <td class="pr-6 pl-1.5 py-4 text-center  ">

                                <form action="{{ route('spaces.destroy', $space->id) }}" method="POST"
                                    class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="bg-red-500 hover:bg-red-700 focus:bg-red-500 text-white rounded-lg px-5 py-1.5 text-sm whitespace-nowrap transition duration-300 ease-in-out">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6"
                                class="bg-white border-b  hover:bg-gray-50 text-center p-8 font-bold text-xl text-gray-400">
                                No data yet
                            </td>
                        </tr>
                    @endforelse

                </tbody>
            </table>
        </div>

        {{-- <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <table class="min-w-full bg-white">
                <thead>
                    <tr>
                        <th class="py-2 px-4 border-b">Image</th>
                        <th class="py-2 px-4 border-b">Name</th>
                        <th class="py-2 px-4 border-b">Price Per Day</th>
                        <th class="py-2 px-4 border-b">Category</th>
                        <th class="py-2 px-4 border-b">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($spaces as $space)
                        <tr>
                            <td class="py-2 px-4 border-b">
                                
                            </td>
                            <td class="py-2 px-4 border-b"></td>
                            <td class="py-2 px-4 border-b"></td>
                            <td class="py-2 px-4 border-b"></td>
                            <td class="py-2 px-4 border-b">
                                <a href=""
                                    class="text-blue-500 hover:text-blue-700">Edit</a> |
                                <form action="" method="POST"
                                    class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div> --}}
    </div>
</x-app-layout>
