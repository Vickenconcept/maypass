<x-app-layout>
    <div class="   h-full">

        <div class=" my-8 border-y  border-gray-500 py-3 px-3 md:px-10 flex space-x-3 items-center ">
            <div>
                <h3 class="font-bold text-xl">My Profile</h3>
            </div>
            <span class="text-sm">Manage your account</span>
        </div>

        <section class="space-y-8  px-3 md:px-10 py-10 bg-white rounded-lg md:w-[70%] mx-auto">
            <div class="">
                <form action="{{ route('changeName') }}" method="POST" class=" space-y-4 ">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2  w-full gap-5">
                        <div>
                            <div class="flex items-center justify-between">
                                <label for="name" class="input-label">Name</label>
                            </div>
                            <div class="mt-2">
                                <input id="name" name="name" type="name" autocomplete="off"
                                    class="form-control2" value="{{ auth()->user()->name }}">
                                @error('name')
                                    <span class="text-xs text-red-400">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <div class="flex items-center justify-between">
                                <label for="email" class="input-label">Email</label>
                            </div>
                            <div class="mt-2">
                                <input id="email" name="email" type="email" autocomplete="off"
                                    class="form-control2" value="{{ auth()->user()->email }}" readonly>
                                @error('email')
                                    <span class="text-xs text-red-400">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>


                    <div class="mt-5">
                        <button type="submit" class="btn-basic">
                            save
                        </button>
                    </div>


                </form>
            </div>


            <div class="space-y-5 ">
                <hr>
                <h1 class=" font-semibold">Changing your password will log you out of every device.</h1>
                <form action="{{ route('changePassword') }}" method="POSt" class=" space-y-4 ">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2  w-full gap-5">
                        <div>
                            <div class="flex items-center justify-between">
                                <label for="password" class="input-label">Old Password</label>
                            </div>
                            <div class="mt-2">
                                <input id="password" name="password" type="password" autocomplete="off"
                                    class="form-control2" placeholder="Enter old password">
                                @error('password')
                                    <span class="text-xs text-red-400">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <div class="flex items-center justify-between">
                                <label for="new_password" class="input-label">New password</label>
                            </div>
                            <div class="mt-2">
                                <input id="new_password" name="new_password" type="new_password" autocomplete="off"
                                    class="form-control2" value="" placeholder="New password">
                                @error('new_password')
                                    <span class="text-xs text-red-400">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="mt-5">
                        <button type="submit" class="btn-basic">
                           
                            save
                        </button>
                    </div>


                </form>
            </div>

        </section>

    </div>


</x-app-layout>
