<x-app-layout>
    <div class="container mx-auto px-4 py-8">
        <div class="flex items-center justify-between mb-10">
            <h1 class="text-2xl font-bold mb-4">Manage Users</h1>
            <a href="{{ route('register') }}" class="btn-primary">Create User</a>
        </div>

      
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 ">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 ">
                    <tr>
                        <th scope="col" class="px-6 py-3">Name</th>
                        <th scope="col" class="px-6 py-3">Email</th>
                        <th scope="col" class="px-6 py-3">Role</th>
                        {{-- <th scope="col" class="px-6 py-3">Actions</th> --}}
                        <th scope="col" class="pr-1.5 pl-6 py-4 text-center">
                        </th>

                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)

                        <tr class="bg-white border-b  hover:bg-gray-50 ">
                            <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap capitalize">
                                {{ $user->name }}</td>
                            <td class="px-6 py-4 capitalize">{{ $user->email }}</td>
                            <td class="px-6 py-4 capitalize">
                                @foreach ($user->roles as $role)
                                    {{ $role->name }}@if (!$loop->last)
                                        ,
                                    @endif
                                @endforeach
                            </td>
                           
                            <td class="pr-1.5 pl-6 py-4 text-center">
                                    <a href="{{ route('admin.users.edit', $user->id) }}" class="btn-primary2">Edit</a>
                            </td>
                            {{-- <td class="pr-6 pl-1.5 py-4 text-center  ">

                                @if ($space->is_available)
                                    <button type="button" data-item-id="{{ $space->id }}"
                                        class="delete-btn bg-red-500 hover:bg-red-700 focus:bg-red-500 text-white rounded-lg px-5 py-1.5 text-sm whitespace-nowrap transition duration-300 ease-in-out">Delete</button>
                                @endif

                            </td> --}}
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


        
        </div>
    </x-app-layout>
