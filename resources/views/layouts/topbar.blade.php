<header class="sticky top-0 z-30 flex w-full bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 h-16 shadow-sm">
    <div class="flex flex-grow items-center justify-between px-4 sm:px-6 lg:px-8">
        <div class="flex items-center gap-2 sm:gap-4 lg:hidden">
            <!-- Hamburger Toggle BTN -->
            <button
                class="z-50 block rounded-md bg-white p-2 shadow-sm border border-gray-200 dark:border-gray-700 dark:bg-gray-800 lg:hidden text-gray-500 hover:text-green-600"
                @click.stop="sidebarOpen = !sidebarOpen"
            >
                <span class="relative block h-5 w-5 cursor-pointer">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" /></svg>
                </span>
            </button>
        </div>

        <div class="hidden sm:block">
            <!-- You can add breadcrumbs or a search bar here later -->
        </div>

        <div class="flex items-center gap-4 ml-auto">
            <!-- User Area -->
            <x-dropdown align="right" width="48">
                <x-slot name="trigger">
                    <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-full text-gray-700 dark:text-gray-300 bg-gray-50 dark:bg-gray-700 hover:text-gray-900 dark:hover:text-gray-100 focus:outline-none transition ease-in-out duration-150">
                        <div class="flex items-center gap-3">
                            <span class="h-8 w-8 rounded-full bg-green-100 text-green-700 dark:bg-green-800 dark:text-green-100 flex items-center justify-center font-bold shadow-sm">
                                {{ substr(Auth::user()->name, 0, 1) }}
                            </span>
                            <div class="hidden md:block text-left">
                                <span class="block text-sm font-semibold text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</span>
                                <span class="block text-[11px] text-gray-500 dark:text-gray-400 capitalize">{{ Auth::user()->roles->pluck('name')->implode(', ') }}</span>
                            </div>
                        </div>

                        <div class="ms-2 hidden md:block text-gray-400">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </div>
                    </button>
                </x-slot>

                <x-slot name="content">
                    <div class="px-4 py-3 border-b border-gray-100 dark:border-gray-700 md:hidden">
                        <p class="text-sm font-semibold text-gray-900 dark:text-white">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400 truncate">{{ Auth::user()->email }}</p>
                    </div>

                    <x-dropdown-link :href="route('profile.edit')">
                        {{ __('Profile') }}
                    </x-dropdown-link>

                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-dropdown-link :href="route('logout')" class="text-red-600 hover:text-red-700 dark:text-red-400"
                                onclick="event.preventDefault();
                                            this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-dropdown-link>
                    </form>
                </x-slot>
            </x-dropdown>
        </div>
    </div>
</header>
