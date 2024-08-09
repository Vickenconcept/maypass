<x-app-layout>
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold mb-4">Manage Categories</h1>

        <div class="flex justify-end mb-4">
            <a href="{{ route('categories.create') }}" class="btn-primary">Create New Category</a>
        </div>

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 ">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 ">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Name
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Description
                        </th>
                        <th scope="col" class="pr-1.5 pl-6 py-4 text-center">

                        </th>
                        <th scope="col" class="pr-6 pl-1.5 py-4 text-center">

                        </th>

                    </tr>
                </thead>
                <tbody>
                    @forelse ($categories as $category)
                        <tr class="bg-white border-b  hover:bg-gray-50 ">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap capitalize">
                                {{ $category->name }}
                            </th>
                            <td class="px-6 py-4 capitalize">
                                {{ $category->description }}
                            </td>
                            <td class="pr-1.5 pl-6 py-4 text-center">
                                <a href="{{ route('categories.edit', $category->id) }}" class="btn-primary2">Edit</a>
                            <td class="pr-6 pl-1.5 py-4 text-center  ">

                                <form action="{{ route('categories.destroy', $category->id) }}" method="POST"
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
                            <td colspan="5"
                                class="bg-white border-b  hover:bg-gray-50 text-center p-8 font-bold text-xl text-gray-400">
                                No data yet
                            </td>
                        </tr>
                    @endforelse

                </tbody>
            </table>
        </div>


    </div>
</x-app-layout>
