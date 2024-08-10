<x-app-layout>
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold mb-5">Available Work Spaces</h1>


        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($spaces as $space)
                <div class="bg-white rounded-lg shadow-md hover:shadow-lg px-5 pt-5 pb-10">
                    <div
                        class="bg-gray-200 rounded-md overflow-hidden group h-[200px]  transition-all duration-700 relative">
                        <div class=" font-bold absolute transition-all duration-700 block w-full h-full bg-gray-500">
                            @if ($space->image)
                                <img src="{{ asset('storage/' . $space->image) }}" alt="{{ $space->name }}"
                                    class="w-full object-cover rounded-lg">
                            @else
                                <img src="{{ asset('images/workspace.jpg') }}" alt="{{ $space->name }}"
                                    class="w-full object-cover rounded-lg">
                            @endif
                        </div>
                        <div
                            class="w-full bg-[#25a0db] group-hover:text-white  h-full relative -translate-x-full group-hover:translate-x-0 transition-all duration-700">
                            <div class=" z-10  h-full flex items-center justify-center">
                                <div class="text-center">
                                    <a href="{{ route('bookings.book', $space->id) }}" class=" hover:underline">
                                        <p class="text-2xl font-bold">Book Now</p>
                                    </a>
                                    <p class="text-md font-bold capitalize">{{ $space->name }}</p>
                                </div>

                            </div>
                        </div>
                    </div>
                    <h2 class="text-lg font-bold mt-2 capitalize">{{ $space->name }}</h2>
                    <p class="text-gray-600 truncate line-clamp-1 capitalize">{{ $space->description }}</p>
                    <p class="text-gray-800 font-bold mt-2 mb-5">${{ $space->price_per_day }}/day</p>
                    <a href="{{ route('bookings.book', $space->id) }}" class=" btn-primary">Book Now</a>
                </div>
            @empty
                <div class="md:col-span-2 lg:col-span-3 bg-white rounded-lg shadow px-5 pt-5 pb-10  w-[50%] mx-auto">
                    <img src="{{ asset('images/undraw_designer_re_5v95.svg') }}" alt="">
                </div>
            @endforelse
        </div>




        {{-- <div
            class="bg-gray-200 rounded-md overflow-hidden group h-[70px] sm:max-w-[250px] md:max-w-[300px] lg:min-w-[230px] xl:min-w-[260px] xl:max-w-[270px] transition-all duration-700 relative">
            <p
                class="mx-10 translate-y-[17px]  text-[20px] md:text-2xl lg:text-[20px] xl:text-[22px] xl:max-w-[27px] font-bold absolute group-hover:text-[#d5d5d5] transition-all duration-700 ">
                Manufacturing</p>
            <div
                class="w-full bg-[#ea5a0ce7] h-[70px] relative -translate-x-full lg:-translate-x-[275px] group-hover:translate-x-0 transition-all duration-700">
                <div
                class=" z-10  h-full">
                
                this is it</div>
            </div>
        </div> --}}

    </div>

</x-app-layout>
