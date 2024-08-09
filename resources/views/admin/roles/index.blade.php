<x-app-layout>
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold mb-4">Manage Roles and Permissions</h1>


        <div class=" shadow-md rounded-lg p-4">
            <h2 class="text-lg font-semibold mb-4">Roles</h2>

            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-3 gap-4 ">
                @foreach ($roles as $key => $role)
                    <div class="bg-white border border-gray-300 rounded-lg p-4 hover:shadow-lg delay-75 transition duration-700 ease-in-out">
                        <h3 class="text-lg font-bold mb-2">{{ $role->name }}</h3>

                        <form action="{{ route('roles.permissions.update', $role->id) }}" method="POST">
                            @csrf
                            <div class="mb-4">
                                <h4 class="font-semibold">Assign Permissions</h4>
                                @foreach ($permissions as $permission)
                                    @if ($permission->name !== 'manage-users')
                                        <div class="flex items-center space-x-1  mb-2">
                                            <input type="checkbox" name="permissions[]" value="{{ $permission->id }}"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2 "
                                                id="permission_{{ $permission->id }}_{{ $key }}"
                                                @if ($role->hasPermissionTo($permission)) checked @endif>
                                            <label for="permission_{{ $permission->id }}_{{ $key }}"
                                                class="font-semibold">{{ $permission->name }}</label>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                            <button type="submit"
                                class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">Update
                                Permissions</button>
                        </form>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
