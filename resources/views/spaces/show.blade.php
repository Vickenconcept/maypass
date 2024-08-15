<x-guest-layout>
    <main class=" ">
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
                            class="w-full bg-[#b30000] bg-opacity-50 group-hover:text-white  h-full relative -translate-x-full group-hover:translate-x-0 transition-all duration-700">
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
