<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-gradient-to-br from-gray-50 via-green-50/30 to-gray-100 dark:from-gray-900 dark:via-gray-900 dark:to-gray-900">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Sistem POC') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased text-gray-900 bg-gradient-to-br from-gray-50 via-green-50/30 to-gray-100 dark:from-gray-900 dark:via-gray-900 dark:to-gray-900 dark:text-gray-100 h-full overflow-hidden" x-data="{ sidebarOpen: false }">
        <div class="flex h-screen overflow-hidden">
            <!-- Sidebar -->
            @include('layouts.sidebar')

            <!-- Main Content Area -->
            <div class="relative flex flex-col flex-1 overflow-y-auto overflow-x-hidden">
                <!-- Page Heading -->
                @isset($header)
                    <header class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-xl shadow-soft border-b border-gray-200/60 dark:border-gray-700/60 sticky top-0 z-30">
                        <div class="px-4 py-4 sm:px-6 lg:px-8 flex items-center gap-4">
                            <button class="lg:hidden text-gray-500 hover:text-green-600 dark:text-gray-400 dark:hover:text-green-400 focus:outline-none shrink-0" @click.stop="sidebarOpen = !sidebarOpen">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" /></svg>
                            </button>
                            <div class="flex-1 overflow-hidden">
                                {{ $header }}
                            </div>
                            
                            <div class="shrink-0">
                                @php
                                    $unreadNotifications = auth()->user()->unreadNotifications;
                                @endphp
                                <x-dropdown align="right" width="80">
                                    <x-slot name="trigger">
                                        <button class="relative p-2 text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200 transition bg-gray-50 dark:bg-gray-700 rounded-full border border-gray-200 dark:border-gray-600">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" /></svg>
                                            @if($unreadNotifications->count() > 0)
                                                <span class="absolute top-0 right-0 inline-flex items-center justify-center px-1.5 py-0.5 text-[10px] font-bold leading-none text-white transform translate-x-1/4 -translate-y-1/4 bg-red-600 rounded-full">{{ $unreadNotifications->count() }}</span>
                                            @endif
                                        </button>
                                    </x-slot>

                                    <x-slot name="content">
                                        <div class="px-4 py-3 border-b border-gray-100 dark:border-gray-700">
                                            <h3 class="text-sm font-semibold text-gray-900 dark:text-white">Notifikasi</h3>
                                        </div>
                                        <div class="max-h-64 overflow-y-auto">
                                            @forelse($unreadNotifications as $notification)
                                                <a href="{{ route('notifications.read', $notification->id) }}" class="block px-4 py-3 border-b border-gray-100 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                                                    <p class="text-sm font-medium text-gray-900 dark:text-gray-100">{{ $notification->data['title'] }}</p>
                                                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">{{ $notification->data['message'] }}</p>
                                                    <p class="text-[10px] text-gray-400 mt-1">{{ $notification->created_at->diffForHumans() }}</p>
                                                </a>
                                            @empty
                                                <div class="px-4 py-6 text-center text-sm text-gray-500 dark:text-gray-400">
                                                    Tidak ada notifikasi baru
                                                </div>
                                            @endforelse
                                        </div>
                                    </x-slot>
                                </x-dropdown>
                            </div>
                        </div>
                    </header>
                @endisset

                <!-- Page Content -->
                <main class="w-full grow p-6 max-w-screen-2xl mx-auto animate-fade-in-up">
                    @if (session('success'))
                        <div class="mb-4 p-4 text-sm text-green-800 rounded-xl bg-gradient-to-r from-green-50 to-emerald-50 dark:from-green-900/30 dark:to-emerald-900/30 dark:text-green-400 border border-green-200/60 dark:border-green-800/40 shadow-sm flex items-center gap-3" role="alert">
                            <svg class="w-5 h-5 text-green-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            {{ session('success') }}
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="mb-4 p-4 text-sm text-red-800 rounded-xl bg-gradient-to-r from-red-50 to-rose-50 dark:from-red-900/30 dark:to-rose-900/30 dark:text-red-400 border border-red-200/60 dark:border-red-800/40 shadow-sm flex items-center gap-3" role="alert">
                            <svg class="w-5 h-5 text-red-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            {{ session('error') }}
                        </div>
                    @endif
                    
                    {{ $slot }}
                </main>
            </div>
        </div>
    </body>
</html>
