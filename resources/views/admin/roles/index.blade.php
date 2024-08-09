<x-app-layout>
    <div class="container mx-auto px-4 py-8">

        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-bold mb-4">Manage Roles and Permissions</h1>
            <a href="{{ route('roles.create') }}" class="btn-primary">Create Role</a>
        </div>

        <div class="  rounded-lg p-4">
            <h2 class="text-xl font-bold mb-4">Roles</h2>

            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-3 gap-4 ">
                @foreach ($roles as $key => $role)
                    <div
                        class="{{ $loop->even ? 'bg-white ' : 'bg-[#25a0db] text-white' }} border border-gray-300 rounded-lg p-4 hover:shadow-lg delay-75 transition duration-700 ease-in-out">
                        <h3 class=" font-bold mb-2 text-xl uppercase">{{ $role->name }}</h3>

                        <form action="{{ route('roles.permissions.update', $role->id) }}" method="POST">
                            @csrf
                            <div class="mb-4">
                                <h4 class="font-semibold">Assign Permissions</h4>
                                @foreach ($permissions as $permission)
                                    <div class="flex items-center space-x-1  mb-2">
                                        <input type="checkbox" name="permissions[]" value="{{ $permission->id }}"
                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2 "
                                            id="permission_{{ $permission->id }}_{{ $key }}"
                                            @if ($role->hasPermissionTo($permission)) checked @endif>
                                        <label for="permission_{{ $permission->id }}_{{ $key }}"
                                            class="font-semibold">{{ $permission->name }}</label>
                                    </div>
                                @endforeach
                            </div>
                            <button type="submit" class="{{ $loop->even ? 'btn-primary' : 'btn-primary2' }}">Update
                                Permissions</button>
                        </form>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
