<x-app-layout>
    <div class="container mx-auto px-4 " >
        <div class="flex justify-between items-center mb-4 border-y  border-gray-500 py-2 ">
            <h1 class="text-2xl font-bold mb-4">Manage Roles and Permissions</h1>
            <a href="{{ route('roles.create') }}" class="btn-primary">Create Role</a>
        </div>

        <div class="  rounded-lg p-4">
            <h2 class="text-xl font-bold mb-4">Roles</h2>

            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-3 gap-4 ">
                @foreach ($roles as $key => $role)
                    <div
                        class="{{ $loop->even ? 'bg-white ' : 'bg-[#b30000] text-white' }} border border-gray-300 rounded-lg p-4 hover:shadow-lg delay-75 transition duration-700 ease-in-out">
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
                            <button data-modal-target="default-modal_{{ $role->id }}" data-modal-toggle="default-modal_{{ $role->id }}"
                                
                                class="block text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center "
                                type="button">
                                Edit
                            </button>
                        </form>
                    </div>

                    <!-- Main modal -->
                    <div id="default-modal_{{ $role->id }}" tabindex="-1" aria-hidden="true"
                        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                        <div class="relative p-4 w-full max-w-2xl max-h-full">
                            <!-- Modal content -->
                            <form action="{{ route('roles.update', $role) }}" method="POST" class="relative bg-white rounded-lg shadow ">
                                @method('PUT')
                                @csrf
                                <!-- Modal header -->
                                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                                    <h3 class="text-xl font-semibold text-gray-900 ">
                                        Edit Role Title 
                                    </h3>
                                    <button type="button"
                                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center "
                                        data-modal-hide="default-modal_{{ $role->id }}">
                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                            fill="none" viewBox="0 0 14 14">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                        </svg>
                                        <span class="sr-only">Close modal</span>
                                    </button>
                                </div>
                                <!-- Modal body -->
                                <div class="p-4 md:p-5 space-y-4">
                                    <div>
                                        <input type="text" name="name" id="" value={{ $role->name }}
                                            class="form-control2">
                                    </div>

                                </div>
                                <!-- Modal footer -->
                                <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b ">
                                    <button data-modal-hide="default-modal_{{ $role->id }}" type="submit"
                                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center ">Submit</button>
                                    <button data-modal-hide="default-modal_{{ $role->id }}" type="button"
                                        class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100">Cancle</button>
                                </div>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

    </div>





</x-app-layout>
