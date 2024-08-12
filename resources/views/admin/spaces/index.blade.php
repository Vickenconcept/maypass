<x-app-layout>
    <div class="container mx-auto px-4 py-8">

        <div class="flex justify-between items-center mb-4 border-y  border-gray-500 py-2  mb-4">
            <h1 class="text-2xl font-bold mb-4">Manage Spaces</h1>
            @can('create-space')
                <a href="{{ route('spaces.create') }}" class="btn-primary">Create New Space</a>
            @endcan
        </div>

        <div class="grid md:grid-cols-2 ">
            <div></div>
            <form method="GET" action="{{ route('spaces.index') }}" class="mb-4">
                <div class="flex space-x-4">
                    <input type="text" name="search" placeholder="Search by name or category"
                        value="" class="form-control2" >

                    <select name="availability" onchange="this.form.submit()" class="form-control2">
                        <option value="all" {{ request('availability') == 'all' ? 'selected' : '' }}>All</option>
                        <option value="available" {{ request('availability') == 'available' ? 'selected' : '' }}>
                            Available</option>
                        <option value="non-available"
                            {{ request('availability') == 'non-available' ? 'selected' : '' }}>Non-Available</option>
                    </select>
                    <button type="submit" class="btn-primary">Search</button>

                </div>
            </form>
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
                        <th scope="col" class="px-6 py-3 text-center">
                            Available
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
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap capitalize ">
                                @if ($space->image)
                                <img src="{{ asset('storage/' . $space->image) }}" alt="{{ $space->name }}"
                                    class="w-12 h-14 object-cover rounded border-2">
                                @else
                                <img src="{{ asset('images/workspace.jpg') }}" alt="{{ $space->name }}"
                                    class="w-12 h-14 object-cover rounded border-2">
                                @endif
                            </th>
                            <td class="px-6 py-4 capitalize">
                                {{ $space->name }}
                            </td>
                            <td class="px-6 py-4 capitalize">
                                #{{ $space->price_per_day }}
                            </td>
                            <td class="px-6 py-4 capitalize">
                                {{ $space->category->name }}
                            </td>
                            <td class="px-6 py-4 capitalize text-center whitespace-nowrap">

                                @if ($space->is_available)
                                    <span
                                        class="border border-green-600 bg-green-100 text-green-600 px-4 py-1 rounded-full font-semibold text-xs ">
                                        Available</span>
                                @else
                                    <span
                                        class="border border-red-500 bg-red-100 text-red-500 px-4 py-1 rounded-full font-semibold text-xs ">
                                        Not Available</span>
                                @endif
                            </td>
                            <td class="pr-1.5 pl-6 py-4 text-center">
                                @can('update-space')
                                    @if ($space->is_available)
                                        <a href="{{ route('spaces.edit', $space->id) }}" class="btn-primary2">Edit</a>
                                    @endif
                                @endcan
                            </td>
                            <td class="pr-6 pl-1.5 py-4 text-center  ">
                                @can('delete-space')
                                    @if ($space->is_available)
                                        <button type="button" data-item-id="{{ $space->id }}"
                                            class="delete-btn bg-red-500 hover:bg-red-700 focus:bg-red-500 text-white rounded-lg px-5 py-1.5 text-sm whitespace-nowrap transition duration-300 ease-in-out">Delete</button>
                                    @endif
                                @endcan

                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7"
                                class="bg-white border-b  hover:bg-gray-50 text-center p-8 font-bold text-xl text-gray-400">
                                No data yet
                            </td>
                        </tr>
                    @endforelse

                </tbody>
            </table>
        </div>
        <div class="mt-4">
            {{ $spaces->links() }}
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
                        text: "You won't be able to revert this!",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Yes, delete it!"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            var deleteRoute =
                                "{{ route('spaces.destroy', ['space' => ':itemId']) }}";
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
