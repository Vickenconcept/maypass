<!--Footer container-->

@php
    // $spaces =  \app\Models\Space::latest()->get();
@endphp
<footer class="flex flex-col items-center bg-[#000000] text-center text-surface text-white ">
    {{-- <div class="container p-6">
        <div class="grid gap-4 md:grid-cols-3 lg:grid-cols-6">
            @foreach ($spaces as $space )
                
            <div class="mb-6 lg:mb-0">
                <img src="https://tecdn.b-cdn.net/img/new/fluid/city/113.webp" class="w-full rounded-md shadow-lg" />
            </div>
            @endforeach
        </div>
    </div> --}}

    <!--Copyright section-->
    <div class="w-full bg-black/5 p-4 text-center">
        © 2023 Copyright:
        <a href="https://tw-elements.com/">May Pass</a>
    </div>
</footer>
