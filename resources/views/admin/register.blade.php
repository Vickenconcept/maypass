<x-app-layout>
    <div class="flex flex-col min-h-full justify-center pt-10">
        <div class="   px-6 py-8 lg:px-8 bg-white rounded-3xl w-full md:w-[60%] lg:w-[40%] mx-auto shadow-xl shadow-[#b30000]">
            <div class="sm:mx-auto sm:w-full sm:max-w-sm">
                <div class="flex justify-center space-x-1">
                    <i class="bx bx-bot text-[#b30000] text-3xl"></i>

                    <h1 class="text-[#b30000] text-2xl"><b>May</b>Pass</h1>
                </div>
                <h2 class=" text-center text-2xl font-bold leading-9 tracking-tight text-[#b30000]">Create User</h2>
            </div>


            <div class=" sm:mx-auto sm:w-full sm:max-w-sm">
                @if ($errors->any())
                    <div class="bg-red-100 text-red-500  p-3 border border-red-500 rounded">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form class="space-y-3" action="{{ route('auth.register') }}" method="POST">
                    @csrf
                    <div>
                        <label for="name" class="input-label text-gray-600">Name</label>
                        <div class="mt-2">
                            <input id="name" name="name" value="{{ old('name') }}" type="text"
                                autocomplete="name" class="form-control2" placeholder="Smith Joe">
                            @error('name')
                                <span class="text-xs text-red-400">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>


                    <div>
                        <label for="email" class="input-label text-gray-600">Email Address</label>
                        <div class="mt-2">
                            <input id="email" name="email" value="{{ old('email') }}" type="text"
                                autocomplete="email" class="form-control2" placeholder="example@gmail.com">
                            @error('email')
                                <span class="text-xs text-red-400">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <div class="flex items-center justify-between">
                            <label for="password" class="input-label text-gray-600">Password</label>
                        </div>
                        <div class="mt-2">
                            <input id="password" name="password" type="password" autocomplete="current-password"
                                class="form-control2" placeholder="********">
                            @error('password')
                                <span class="text-xs text-red-400">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>


                    <div>
                        <div class="flex items-center justify-between">
                            <label for="role" class="input-label text-gray-600">Role</label>
                        </div>
                        <div class="mt-2">
                            <select name="role" id="role" class="form-control2">
                                <option selected></option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                @endforeach
                            </select>

                        </div>
                    </div>
                  

                    <div class="pt-2">
                        <button type="submit" class="btn-basic ">Register</button>
                    </div>
                </form>


            </div>
        </div>
    </div>

</x-app-layout>
