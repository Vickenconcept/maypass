<x-guest-layout>

    <x-navbar />
    <aside id="logo-sidebar"
        class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-[#c9eeff] sm:translate-x-0 "
        aria-label="Sidebar">
        <div class="h-full px-3 pb-4 overflow-y-auto bg-[#c9eeff] ">
            <ul class="space-y-2 font-medium">
                <li>
                    <div class="flex items-center p-2 text-gray-900 rounded-lg  hover:bg-gray-100 ">
                        <svg class="w-5 h-5 text-gray-500 transition duration-75  group-hover:text-gray-900 "
                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 21">
                            <path
                                d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z" />
                            <path
                                d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z" />
                        </svg>
                        <span
                            class="ms-3 bg-gradient-to-r from-green-500 to-blue-600   inline-block text-transparent bg-clip-text mb-3">{{ $space->name }}</span>
                    </div>
                </li>
                <ul class="space-y-2 font-medium">
                    <li>
                        <a href="#" class="flex items-center p-2 text-gray-900 rounded-lg  hover:bg-gray-100 ">
                            <svg class="w-5 h-5 text-gray-500 transition duration-75  group-hover:text-gray-900 "
                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                viewBox="0 0 22 21">
                                <path
                                    d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z" />
                                <path
                                    d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z" />
                            </svg>
                            <span class="ms-3">Dashboard</span>
                        </a>
                    </li>

                </ul>
        </div>
    </aside>



    <main class=" sm:ml-64">
        <div class="p-4 rounded-lg mt-14">
            <div class=" mx-auto px-4">

                <div class="mb-5 py-4 border-b border-gray-500">
                    @if (auth()->id() == $owner->id)
                        <div>
                            <button data-modal-target="add-member-modal" data-modal-toggle="add-member-modal"
                                class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center"
                                type="button">
                                Add Member
                            </button>
                        </div>
                    @endif
                </div>


                <section class="md:w-[80%] mx-auto">
                    <div
                        class="bg-gray-200 rounded-md overflow-hidden group h-[400px]  transition-all duration-700 relative">
                        <div class=" font-bold absolute transition-all duration-700 block w-full h-full bg-gray-500">
                            @if ($space->image)
                                <img src="{{ asset('storage/' . $space->image) }}" alt="{{ $space->name }}"
                                    class="w-full object-cover rounded-lg">
                            @else
                                <img src="{{ asset('images/workspace.jpg') }}" alt="{{ $space->name }}"
                                    class="w-full object-cover rounded-lg">
                            @endif
                        </div>
                        {{-- <div
                            class="w-full bg-[#25a0db] bg-opacity-50 group-hover:text-white  h-full relative -translate-x-full group-hover:translate-x-0 transition-all duration-700">
                            <div class=" z-10  h-full flex items-center justify-center">
                                <div class="text-center">
                                    <a href="{{ route('bookings.book', $space->id) }}" class=" hover:underline">
                                        <p class="text-2xl font-bold">Book Now</p>
                                    </a>
                                    <p class="text-md font-bold capitalize">{{ $space->name }}</p>
                                </div>

                            </div>
                        </div> --}}
                    </div>
                </section>

                <p class="text-center mb-10 ">{{ $space->description }}</p>

            </div>
        </div>



        <!-- Modal toggle -->


        <!-- Main modal -->
        <div id="add-member-modal" tabindex="-1" aria-hidden="true"
            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-2xl max-h-full">
                <!-- Modal content -->
                <form class="relative bg-white rounded-lg shadow " method="POST"
                    action="{{ route('workspace.add-user', $space->id) }}">
                    @csrf
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t ">
                        <h3 class="text-xl font-semibold text-gray-900 ">
                            Add Member
                        </h3>
                        <button type="button"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center "
                            data-modal-hide="add-member-modal">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="p-4 md:p-5 space-y-4">
                        <input type="text" name="email" id="email" class="form-control2" required
                            autocomplete="off">
                    </div>
                    <!-- Modal footer -->
                    <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                        <button type="submit" class="btn-primary">Submit</button>
                        <button data-modal-hide="add-member-modal" type="button"
                            class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 ">Decline</button>
                    </div>
                </form>
            </div>
        </div>

    </main>



</x-guest-layout>
