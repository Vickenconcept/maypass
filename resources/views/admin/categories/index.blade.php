<x-app-layout>
    <div class="container mx-auto px-4 ">

        <div class="flex justify-between items-center mb-4 border-y  border-gray-500 py-2  mb-4">
            <h1 class="text-2xl font-bold mb-4">Manage Categories</h1>
            @can('create-category')
                <a href="{{ route('categories.create') }}" class="btn-primary">Create New Category</a>
            @endcan
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
                                @can('update-category')
                                    <a href="{{ route('categories.edit', $category->id) }}" class="btn-primary2">Edit</a>
                                @endcan
                            <td class="pr-6 pl-1.5 py-4 text-center  ">

                                @can('delete-category')
                                   
                                        <button type="button" data-item-id="{{ $category->id }}"
                                            class="delete-btn bg-red-500 hover:bg-red-700 focus:bg-red-500 text-white rounded-lg px-5 py-1.5 text-sm whitespace-nowrap transition duration-300 ease-in-out">Delete</button>
                                @endcan
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

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let deleteButtons = document.querySelectorAll('.delete-btn');

            deleteButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    let itemId = button.getAttribute('data-item-id');

                    Swal.fire({
                        title: "Are you sure?",
                        text: "Work space with this category will be deleted!",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Yes, delete it!"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            var deleteRoute =
                                "{{ route('categories.destroy', ['category' => ':itemId']) }}";
                            deleteRoute = deleteRoute.replace(':itemId', itemId);

                            fetch(deleteRoute, {
                                    method: 'DELETE',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                    }
                                })
                                .then(response => {
                                    Swal.fire({
                                        title: "Deleted!",
                                        text: "Your item has been deleted.",
                                        icon: "success"
                                    }).then(() => {
                                        location
                                            .reload();
                                    });
                                })
                                .catch(error => {
                                    Swal.fire("Error", "Failed to delete the item",
                                        "error");
                                });
                        }
                    });
                });
            });
        });
    </script>
</x-app-layout>
