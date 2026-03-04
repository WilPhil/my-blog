<nav class="bg-gray-800">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 items-center justify-between">
            <div class="flex items-center">
                <div class="shrink-0">
                    <img
                        src="https://tailwindcss.com/plus-assets/img/logos/mark.svg?color=indigo&shade=500"
                        alt="Your Company"
                        class="size-8"
                    />
                </div>
                <div class="hidden md:block">
                    <div class="ml-10 flex items-baseline space-x-4">
                        <x-fe-nav-link href="/" :current="request()->is('/')">Home</x-fe-nav-link>
                        <x-fe-nav-link href="/posts" :current="request()->is('posts')">Blog</x-fe-nav-link>
                        <x-fe-nav-link href="/about" :current="request()->is('about')">About</x-fe-nav-link>
                        <x-fe-nav-link href="/contact" :current="request()->is('contact')">Contact</x-fe-nav-link>
                    </div>
                </div>
            </div>
            <div class="hidden md:block">
                @if (Auth::check())
                    <div class="ml-4 flex items-center md:ml-6">
                        <!-- Profile dropdown -->
                        <el-dropdown class="relative ml-3">
                            <button
                                class="relative flex max-w-xs items-center rounded-full focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500 cursor-pointer"
                            >
                                <span class="absolute -inset-1.5"></span>
                                <span class="sr-only">Open user menu</span>
                                <div class="text-gray-300 text-sm font-medium mr-3">{{ Auth::user()->name }}</div>
                                <img
                                    src="{{ Auth::user()->avatar ? asset("storage/" . Auth::user()->avatar) : asset("img/default.jpg") }}"
                                    alt="{{ Auth::user()->name }}"
                                    class="size-8 rounded-full outline -outline-offset-1 outline-white/10"
                                />
                            </button>

                            <el-menu
                                anchor="bottom end"
                                popover
                                class="w-48 origin-top-right rounded-md bg-white py-1 shadow-lg outline-1 outline-black/5 transition transition-discrete [--anchor-gap:--spacing(2)] data-closed:scale-95 data-closed:transform data-closed:opacity-0 data-enter:duration-100 data-enter:ease-out data-leave:duration-75 data-leave:ease-in"
                            >
                                <a
                                    href="/profile"
                                    class="block px-4 py-2 text-sm text-gray-700 focus:bg-gray-100 focus:outline-hidden"
                                >
                                    Your profile
                                </a>
                                <a
                                    href="{{ route("dashboard.index") }}"
                                    class="block px-4 py-2 text-sm text-gray-700 focus:bg-gray-100 focus:outline-hidden"
                                >
                                    Settings
                                </a>
                                <form method="POST" action="/logout">
                                    @csrf
                                    <button
                                        type="submit"
                                        class="block w-full text-start px-4 py-2 text-sm text-gray-700 focus:bg-gray-100 focus:outline-hidden cursor-pointer"
                                    >
                                        Log out
                                    </button>
                                </form>
                            </el-menu>
                        </el-dropdown>
                    </div>
                @else
                    <div>
                        <a href="/login" class="text-gray-300 text-sm font-medium">Login</a>
                        <span class="text-gray-300 text-sm mx-3">|</span>
                        <a href="/register" class="text-gray-300 text-sm font-medium">Register</a>
                    </div>
                @endif
            </div>
            <div class="-mr-2 flex md:hidden">
                <!-- Mobile menu button -->
                <button
                    type="button"
                    command="--toggle"
                    commandfor="mobile-menu"
                    class="relative inline-flex items-center justify-center rounded-md p-2 text-gray-400 hover:bg-white/5 hover:text-white focus:outline-2 focus:outline-offset-2 focus:outline-indigo-500"
                >
                    <span class="absolute -inset-0.5"></span>
                    <span class="sr-only">Open main menu</span>
                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.5"
                        data-slot="icon"
                        aria-hidden="true"
                        class="size-6 in-aria-expanded:hidden"
                    >
                        <path
                            d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        />
                    </svg>
                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.5"
                        data-slot="icon"
                        aria-hidden="true"
                        class="size-6 not-in-aria-expanded:hidden"
                    >
                        <path d="M6 18 18 6M6 6l12 12" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <el-disclosure id="mobile-menu" hidden class="block md:hidden">
        <div class="space-y-1 px-2 pt-2 pb-3 sm:px-3">
            <x-fe-nav-link href="/" :current="request()->is('home')" class="block">Home</x-fe-nav-link>
            <x-fe-nav-link href="/posts" :current="request()->is('posts')" class="block">Blog</x-fe-nav-link>
            <x-fe-nav-link href="/about" :current="request()->is('about')" class="block">About</x-fe-nav-link>
            <x-fe-nav-link href="/contact" :current="request()->is('contact')" class="block">Contact</x-fe-nav-link>
        </div>
        <div class="border-t border-white/10 pt-4 pb-3">
            @if (Auth::check())
                <div class="flex items-center px-5">
                    <div class="shrink-0">
                        <img
                            src="{{ Auth::user()->avatar ? asset("storage/" . Auth::user()->avatar) : asset("img/default.jpg") }}"
                            alt="{{ Auth::user()->name }}"
                            class="size-10 rounded-full outline -outline-offset-1 outline-white/10"
                        />
                    </div>
                    <div class="ml-3">
                        <div class="text-base/5 font-medium text-white">
                            {{ Auth::user()->name }}
                        </div>
                        <div class="text-sm font-medium text-gray-400">
                            {{ Auth::user()->email }}
                        </div>
                    </div>
                </div>
                <div class="mt-3 space-y-1 px-2">
                    <a
                        href="/profile"
                        class="block rounded-md px-3 py-2 text-base font-medium text-gray-400 hover:bg-white/5 hover:text-white"
                    >
                        Your profile
                    </a>
                    <a
                        href="{{ route("dashboard.index") }}"
                        class="block rounded-md px-3 py-2 text-base font-medium text-gray-400 hover:bg-white/5 hover:text-white"
                    >
                        Settings
                    </a>
                    <form method="POST" action="/logout">
                        @csrf
                        <button
                            type="submit"
                            class="block text-start w-full rounded-md px-3 py-2 text-base font-medium text-gray-400 hover:bg-white/5 hover:text-white cursor-pointer"
                        >
                            Log out
                        </button>
                    </form>
                </div>
            @else
                <div class="flex flex-col items-start px-2">
                    <a
                        href="/login"
                        class="block w-full rounded-md px-3 py-2 text-base font-medium text-gray-400 hover:bg-white/5 hover:text-white"
                    >
                        Login
                    </a>
                    <a
                        href="/register"
                        class="block w-full rounded-md px-3 py-2 text-base font-medium text-gray-400 hover:bg-white/5 hover:text-white"
                    >
                        Register
                    </a>
                </div>
            @endif
        </div>
    </el-disclosure>
</nav>
