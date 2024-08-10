<nav class=" border-gray-200 bg-[#25a0db]">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto py-4 px-10">
        <a href="https://flowbite.com/" class="flex items-center space-x-3 rtl:space-x-reverse">
            <img src="https://flowbite.com/docs/images/logo.svg" class="h-8" alt="Flowbite Logo" />
            <span class="self-center text-2xl font-semibold whitespace-nowrap ">Flowbite</span>
        </a>
        <button data-collapse-toggle="navbar-default" type="button"
            class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm  rounded-lg md:hidden  focus:outline-none focus:ring-2  text-gray-400 hover:bg-gray-700 focus:ring-gray-600"
            aria-controls="navbar-default" aria-expanded="false">
            <span class="sr-only">Open main menu</span>
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 17 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M1 1h15M1 7h15M1 13h15" />
            </svg>
        </button>
        <div class="hidden w-full md:block md:w-auto" id="navbar-default">
            <ul
                class="font-medium flex flex-col p-4 md:p-0 mt-4 border  rounded-lg  md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0  ">
                <li>
                    <a href="/" class="block py-2 px-3  text-white rounded md:bg-transparent  md:p-0  "
                        aria-current="page">Home</a>
                </li>
                <li>
                    <a href="{{ route('spaces.index') }}"
                        class="block py-2 px-3 rounded md:border-0 text-white md:hover:text-gray-300 md:p-0   hover:bg-gray-700 hover: md:hover:bg-transparent">Work
                        Spaces</a>
                </li>
                @can('create-category')
                    <li>
                        <a href="{{ route('categories.index') }}"
                            class="block py-2 px-3 rounded md:border-0 text-white md:hover:text-gray-300 md:p-0   hover:bg-gray-700 hover: md:hover:bg-transparent">Categories</a>
                    </li>
                @endcan

                <li>
                    <a href="{{ route('bookings.index') }}"
                        class="block py-2 px-3 rounded md:border-0 text-white md:hover:text-gray-300 md:p-0   hover:bg-gray-700 hover: md:hover:bg-transparent">Bookings</a>
                </li>
                @auth

                    <li class="flex item-center justify-center">
                        <button id="dropdownNotificationButton" data-dropdown-toggle="dropdownNotification"
                            class="relative inline-flex items-center text-sm font-medium text-center text-white hover:text-gray-100 focus:outline-none "
                            type="button">
                            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                viewBox="0 0 14 20">
                                <path
                                    d="M12.133 10.632v-1.8A5.406 5.406 0 0 0 7.979 3.57.946.946 0 0 0 8 3.464V1.1a1 1 0 0 0-2 0v2.364a.946.946 0 0 0 .021.106 5.406 5.406 0 0 0-4.154 5.262v1.8C1.867 13.018 0 13.614 0 14.807 0 15.4 0 16 .538 16h12.924C14 16 14 15.4 14 14.807c0-1.193-1.867-1.789-1.867-4.175ZM3.823 17a3.453 3.453 0 0 0 6.354 0H3.823Z" />
                            </svg>

                            <div
                                class="absolute  w-4 h-4 text-white p-1 flex  items-center justify-center bg-red-500 border-2 text-xs border-white rounded-full -top-0.5 start-2.5 d">
                                <p>
                                    @if (auth()->user()->unreadNotifications->count() > 0)
                                        {{ auth()->user()->unreadNotifications->count() }}
                                    @endif
                                </p>
                            </div>
                        </button>

                        <!-- Dropdown menu -->
                        <div id="dropdownNotification"
                            class="z-20 hidden w-full max-w-sm bg-white divide-y divide-gray-100 rounded-lg shadow "
                            aria-labelledby="dropdownNotificationButton">
                            <div class="block px-4 py-2 font-medium text-center text-gray-700 rounded-t-lg bg-gray-50 ">
                                Notifications
                            </div>
                            <div
                                class="divide-y divide-gray-100 overflow-y-auto  {{ auth()->user()->unreadNotifications->count() > 1 ? 'h-44 ' : '' }}">
                                @foreach (auth()->user()->unreadNotifications as $notification)
                                    <a href="{{ route('notifications.read_one', $notification->id) }}"
                                        class="flex px-4 py-3 hover:bg-gray-100 ">
                                        <div class="flex-shrink-0">

                                            <div
                                                class="absolute flex items-center justify-center w-5 h-5 ms-6 -mt-5 bg-blue-600 border border-white rounded-full ">
                                                <svg class="w-2 h-2 text-white" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                    viewBox="0 0 18 18">
                                                    <path
                                                        d="M1 18h16a1 1 0 0 0 1-1v-6h-4.439a.99.99 0 0 0-.908.6 3.978 3.978 0 0 1-7.306 0 .99.99 0 0 0-.908-.6H0v6a1 1 0 0 0 1 1Z" />
                                                    <path
                                                        d="M4.439 9a2.99 2.99 0 0 1 2.742 1.8 1.977 1.977 0 0 0 3.638 0A2.99 2.99 0 0 1 13.561 9H17.8L15.977.783A1 1 0 0 0 15 0H3a1 1 0 0 0-.977.783L.2 9h4.239Z" />
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="w-full ps-3">
                                            <div class="text-gray-500 text-sm mb-1.5 ">New message from
                                                <span class="font-semibold text-gray-900 ">{{ $notification->data['name'] }}
                                                </span>: "{{ $notification->data['message'] }}"
                                            </div>
                                            <div class="text-xs text-blue-600 ">
                                                {{ $notification->created_at->diffForHumans() }}</div>
                                        </div>
                                    </a>
                                @endforeach

                            </div>

                            <a href="{{ route('notifications.mark-as-read') }}"
                                class="block py-2 text-sm font-medium text-center text-gray-900 rounded-b-lg bg-gray-50 hover:bg-gray-100 ">
                                <div class="inline-flex items-center ">

                                    <span class="hover:underline">Mark all as read
                                        ({{ auth()->user()->unreadNotifications->count() }})</span>
                                </div>
                            </a>
                        </div>


                    <li>
                    @endauth
                    <div class="flex items-center ms-3 space-x-4">
                        <button type="button"
                            class="flex text-sm items-center hover:bg-gray-50 rounded-full focus:ring-4 focus:ring-gray-100 md:space-x-2"
                            aria-expanded="false" data-dropdown-toggle="dropdown-user">
                            <span class="sr-only">Open user menu</span>

                            <img class="w-8 h-8 rounded-full"
                                src="https://flowbite.com/docs/images/people/profile-picture-5.jpg" alt="user photo">
                            @if (auth()->check())
                                <p class="text-sm font-semibold hidden md:block">{{ auth()->user()->name }} </p>
                            @endif
                            <i class='bx bx-chevron-down text-xl hidden md:block'></i>
                        </button>

                    </div>
                </li>
                <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded shadow"
                    id="dropdown-user">
                    <div class="px-4 py-3" role="none">
                        @if (auth()->check())
                            <p class="text-sm text-gray-500 " role="none">
                                {{ auth()->user()->name }}
                            </p>
                        @endif
                        @if (auth()->check())
                            <p class="text-xs font-medium text-gray-500 truncate " role="none">
                                {{ auth()->user()->email }}
                            </p>
                        @endif
                    </div>
                    <ul class="py-1" role="none">
                        @role('super-admin')
                            <li>

                                <a href="{{ route('roles.index') }}"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Roles</a>

                            </li>
                        @endrole
                        @can('manage-users')
                            <li>
                                <a href="{{ route('admin.users.index') }}"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Users</a>
                            </li>
                        @endcan
                        <li>
                            @if (auth()->check())
                                <form action="{{ route('auth.logout') }}" method="POST">
                                    @csrf
                                    <a href="javascript:void(0)" onclick="logout(this)"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Sign
                                        out</a>
                                </form>
                            @else
                                <a href="{{ route('login') }}"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Sign
                                    In</a>
                            @endif
                        </li>
                    </ul>
                </div>
            </ul>

        </div>
    </div>
</nav>
