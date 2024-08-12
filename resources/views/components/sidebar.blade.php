<aside id="logo-sidebar"
    class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-[#000000] sm:translate-x-0 "
    aria-label="Sidebar">
    <div class="h-full px-3 pb-4 overflow-y-auto bg-[#000000] ">
        <ul class="space-y-2 font-medium">
            <li>
                <div class="flex items-center p-2 text-gray-900 rounded-lg  hover:bg-red-800  bg-opacity-80">
                    <svg class="w-5 h-5 text-gray-500 transition duration-75  group-hover:text-gray-900 "
                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 21">
                        <path
                            d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z" />
                        <path
                            d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z" />
                    </svg>
                    <span
                        class="ms-3 bg-gradient-to-r from-green-500 to-blue-600   inline-block text-transparent bg-clip-text mb-3">vvvvv</span>
                </div>
            </li>
            <ul class="space-y-2 font-medium">
                <li>
                    <a href="#"
                        class="flex items-center p-2 text-white rounded-lg  hover:bg-red-800  bg-opacity-80">
                        <svg class="w-5 h-5 text-gray-500 transition duration-75  group-hover:text-white "
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


                <li>
                    <a href="/"
                        class="flex items-center p-2 text-white rounded-lg  hover:bg-red-800    @if (request()->routeIs('home')) bg-red-500 bg-opacity-30 @endif "
                        aria-current="page">
                        <svg class="w-5 h-5 text-gray-500 transition duration-75  group-hover:text-white "
                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 22 21">
                            <path
                                d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z" />
                            <path
                                d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z" />
                        </svg>
                        <span class="ms-3">Home</span>
                    </a>
                </li>
                @can('view-space')
                    <li>
                        <a href="{{ route('spaces.index') }}"
                            class="flex items-center p-2 text-white rounded-lg  hover:bg-red-800   @if (request()->routeIs('spaces.index')) bg-red-500 bg-opacity-30 @endif">
                            <svg class="w-5 h-5 text-gray-500 transition duration-75  group-hover:text-white "
                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                viewBox="0 0 22 21">
                                <path
                                    d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z" />
                                <path
                                    d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z" />
                            </svg>
                            <span class="ms-3">Work Spaces</span>
                        </a>
                    </li>
                @endcan
                @can('view-category')
                    <li>
                        <a href="{{ route('categories.index') }}"
                            class="flex items-center p-2 text-white rounded-lg  hover:bg-red-800   @if (request()->routeIs('categories.index')) bg-red-500 bg-opacity-30 @endif">
                            <svg class="w-5 h-5 text-gray-500 transition duration-75  group-hover:text-white "
                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                viewBox="0 0 22 21">
                                <path
                                    d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z" />
                                <path
                                    d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z" />
                            </svg>
                            <span class="ms-3">Categories</span>
                        </a>
                    </li>
                @endcan

                @can('view-bookings')
                    <li>
                        <a href="{{ route('bookings.index') }}"
                            class="flex items-center p-2 text-white rounded-lg  hover:bg-red-800   @if (request()->routeIs('bookings.index')) bg-red-500 bg-opacity-30 @endif">
                            <svg class="w-5 h-5 text-gray-500 transition duration-75  group-hover:text-white "
                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                viewBox="0 0 22 21">
                                <path
                                    d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z" />
                                <path
                                    d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z" />
                            </svg>
                            <span class="ms-3">Bookings</span>
                        </a>
                    </li>
                @endcan

                @role('super-admin')
                    <li>

                        <a href="{{ route('roles.index') }}"
                            class="flex items-center p-2 text-white rounded-lg  hover:bg-red-800   @if (request()->routeIs('roles.index')) bg-red-500 bg-opacity-30 @endif">
                            <svg class="w-5 h-5 text-gray-500 transition duration-75  group-hover:text-white "
                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                viewBox="0 0 22 21">
                                <path
                                    d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z" />
                                <path
                                    d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z" />
                            </svg>
                            <span class="ms-3">Roles</span>
                        </a>

                    </li>
                @endrole
                @can('manage-users')
                    <li>
                        <a href="{{ route('admin.users.index') }}"
                            class="flex items-center p-2 text-white rounded-lg  hover:bg-red-800   @if (request()->routeIs('admin.users.index')) bg-red-500 bg-opacity-30 @endif">
                            <svg class="w-5 h-5 text-gray-500 transition duration-75  group-hover:text-white "
                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                viewBox="0 0 22 21">
                                <path
                                    d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z" />
                                <path
                                    d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z" />
                            </svg>
                            <span class="ms-3">Users</span>
                        </a>
                    </li>
                @endcan

            </ul>
    </div>
</aside>
