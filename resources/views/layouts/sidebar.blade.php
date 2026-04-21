<aside
    class="absolute left-0 top-0 z-40 flex h-screen w-64 flex-col overflow-y-hidden bg-white/90 backdrop-blur-xl duration-300 ease-linear dark:bg-gray-800/95 lg:static lg:translate-x-0 shadow-soft-xl border-r border-gray-200/50 dark:border-gray-700/50"
    :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
    @click.outside="sidebarOpen = false"
>
    <!-- Sidebar Header -->
    <div class="flex items-center justify-center gap-2 px-6 py-5.5 lg:py-6.5 border-b border-gray-200/50 dark:border-gray-700/50 h-16 ">
        <a href="{{ route('dashboard') }}" class="flex items-center gap-3">
            <img src="{{ asset('images/logo.png') }}" alt="BioLuxe Logo" class="h-8 w-auto">
        </a>

        <button class="block lg:hidden text-white/80 hover:text-white" @click.stop="sidebarOpen = !sidebarOpen">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
        </button>
    </div>

    <!-- Sidebar Menu -->
    <div class="flex flex-col overflow-y-auto duration-300 ease-linear hide-scrollbar flex-1">
        <nav class="mt-5 px-4 lg:mt-6 lg:px-4">
            <div>
                <h3 class="mb-3 ml-4 text-xs font-semibold text-gray-400 dark:text-gray-500 uppercase tracking-wider">Menu Utama</h3>
                <ul class="mb-6 flex flex-col gap-1">
                    <li>
                        <a href="{{ route('dashboard') }}" class="group relative flex items-center gap-3 rounded-lg px-4 py-2.5 font-medium text-sm transition-all duration-200 {{ request()->routeIs('dashboard') ? 'bg-gradient-to-r from-green-50 to-emerald-50 dark:from-green-900/30 dark:to-emerald-900/20 text-green-700 dark:text-green-400 shadow-sm border border-green-200/60 dark:border-green-800/40' : 'text-gray-600 dark:text-gray-300 hover:bg-gray-50 hover:text-green-700 dark:hover:bg-gray-700/50 hover:translate-x-1' }}">
                            <svg class="w-5 h-5 {{ request()->routeIs('dashboard') ? 'text-green-600 dark:text-green-400' : 'text-gray-400 group-hover:text-green-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" /></svg>
                            Dashboard
                        </a>
                    </li>
                </ul>

                @hasanyrole('admin|staff_produksi')
                <h3 class="mb-3 ml-4 text-xs font-semibold text-gray-400 dark:text-gray-500 uppercase tracking-wider">Produksi & Bahan Baku</h3>
                <ul class="mb-6 flex flex-col gap-1">
                    <li>
                        <a href="{{ route('suppliers.index') }}" class="group relative flex items-center gap-3 rounded-lg px-4 py-2.5 font-medium text-sm transition-all duration-200 {{ request()->routeIs('suppliers.*') ? 'bg-gradient-to-r from-green-50 to-emerald-50 dark:from-green-900/30 dark:to-emerald-900/20 text-green-700 dark:text-green-400 shadow-sm border border-green-200/60 dark:border-green-800/40' : 'text-gray-600 dark:text-gray-300 hover:bg-gray-50 hover:text-green-700 dark:hover:bg-gray-700/50 hover:translate-x-1' }}">
                            <svg class="w-5 h-5 {{ request()->routeIs('suppliers.*') ? 'text-green-600 dark:text-green-400' : 'text-gray-400 group-hover:text-green-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                            Supplier
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('waste-purchases.index') }}" class="group relative flex items-center gap-3 rounded-lg px-4 py-2.5 font-medium text-sm transition-all duration-200 {{ request()->routeIs('waste-purchases.*') ? 'bg-gradient-to-r from-green-50 to-emerald-50 dark:from-green-900/30 dark:to-emerald-900/20 text-green-700 dark:text-green-400 shadow-sm border border-green-200/60 dark:border-green-800/40' : 'text-gray-600 dark:text-gray-300 hover:bg-gray-50 hover:text-green-700 dark:hover:bg-gray-700/50 hover:translate-x-1' }}">
                            <svg class="w-5 h-5 {{ request()->routeIs('waste-purchases.*') ? 'text-green-600 dark:text-green-400' : 'text-gray-400 group-hover:text-green-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                            Pembelian Sampah
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('production-batches.index') }}" class="group relative flex items-center gap-3 rounded-lg px-4 py-2.5 font-medium text-sm transition-all duration-200 {{ request()->routeIs('production-batches.*') ? 'bg-gradient-to-r from-green-50 to-emerald-50 dark:from-green-900/30 dark:to-emerald-900/20 text-green-700 dark:text-green-400 shadow-sm border border-green-200/60 dark:border-green-800/40' : 'text-gray-600 dark:text-gray-300 hover:bg-gray-50 hover:text-green-700 dark:hover:bg-gray-700/50 hover:translate-x-1' }}">
                            <svg class="w-5 h-5 {{ request()->routeIs('production-batches.*') ? 'text-green-600 dark:text-green-400' : 'text-gray-400 group-hover:text-green-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" /></svg>
                            Batch Produksi
                        </a>
                    </li>
                </ul>
                @endhasanyrole

                @hasanyrole('admin|kasir')
                <h3 class="mb-3 ml-4 text-xs font-semibold text-gray-400 dark:text-gray-500 uppercase tracking-wider">Penjualan (POS)</h3>
                <ul class="mb-6 flex flex-col gap-1">
                    <li>
                        <a href="{{ route('customers.index') }}" class="group relative flex items-center gap-3 rounded-lg px-4 py-2.5 font-medium text-sm transition-all duration-200 {{ request()->routeIs('customers.*') ? 'bg-gradient-to-r from-green-50 to-emerald-50 dark:from-green-900/30 dark:to-emerald-900/20 text-green-700 dark:text-green-400 shadow-sm border border-green-200/60 dark:border-green-800/40' : 'text-gray-600 dark:text-gray-300 hover:bg-gray-50 hover:text-green-700 dark:hover:bg-gray-700/50 hover:translate-x-1' }}">
                            <svg class="w-5 h-5 {{ request()->routeIs('customers.*') ? 'text-green-600 dark:text-green-400' : 'text-gray-400 group-hover:text-green-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                            Customer
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('sales.index') }}" class="group relative flex items-center gap-3 rounded-lg px-4 py-2.5 font-medium text-sm transition-all duration-200 {{ request()->routeIs('sales.*') ? 'bg-gradient-to-r from-green-50 to-emerald-50 dark:from-green-900/30 dark:to-emerald-900/20 text-green-700 dark:text-green-400 shadow-sm border border-green-200/60 dark:border-green-800/40' : 'text-gray-600 dark:text-gray-300 hover:bg-gray-50 hover:text-green-700 dark:hover:bg-gray-700/50 hover:translate-x-1' }}">
                            <svg class="w-5 h-5 {{ request()->routeIs('sales.*') ? 'text-green-600 dark:text-green-400' : 'text-gray-400 group-hover:text-green-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                            Transaksi POS
                        </a>
                    </li>
                </ul>
                @endhasanyrole

                @role('admin')
                <h3 class="mb-3 ml-4 text-xs font-semibold text-gray-400 dark:text-gray-500 uppercase tracking-wider">Master Data & Laporan</h3>
                <ul class="mb-6 flex flex-col gap-1">
                    <li>
                        <a href="{{ route('users.index') }}" class="group relative flex items-center gap-3 rounded-lg px-4 py-2.5 font-medium text-sm transition-all duration-200 {{ request()->routeIs('users.*') ? 'bg-gradient-to-r from-green-50 to-emerald-50 dark:from-green-900/30 dark:to-emerald-900/20 text-green-700 dark:text-green-400 shadow-sm border border-green-200/60 dark:border-green-800/40' : 'text-gray-600 dark:text-gray-300 hover:bg-gray-50 hover:text-green-700 dark:hover:bg-gray-700/50 hover:translate-x-1' }}">
                            <svg class="w-5 h-5 {{ request()->routeIs('users.*') ? 'text-green-600 dark:text-green-400' : 'text-gray-400 group-hover:text-green-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                            Manajemen User
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('waste-categories.index') }}" class="group relative flex items-center gap-3 rounded-lg px-4 py-2.5 font-medium text-sm transition-all duration-200 {{ request()->routeIs('waste-categories.*') ? 'bg-gradient-to-r from-green-50 to-emerald-50 dark:from-green-900/30 dark:to-emerald-900/20 text-green-700 dark:text-green-400 shadow-sm border border-green-200/60 dark:border-green-800/40' : 'text-gray-600 dark:text-gray-300 hover:bg-gray-50 hover:text-green-700 dark:hover:bg-gray-700/50 hover:translate-x-1' }}">
                            <svg class="w-5 h-5 {{ request()->routeIs('waste-categories.*') ? 'text-green-600 dark:text-green-400' : 'text-gray-400 group-hover:text-green-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" /></svg>
                            Kategori Sampah
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('products.index') }}" class="group relative flex items-center gap-3 rounded-lg px-4 py-2.5 font-medium text-sm transition-all duration-200 {{ request()->routeIs('products.*') ? 'bg-gradient-to-r from-green-50 to-emerald-50 dark:from-green-900/30 dark:to-emerald-900/20 text-green-700 dark:text-green-400 shadow-sm border border-green-200/60 dark:border-green-800/40' : 'text-gray-600 dark:text-gray-300 hover:bg-gray-50 hover:text-green-700 dark:hover:bg-gray-700/50 hover:translate-x-1' }}">
                            <svg class="w-5 h-5 {{ request()->routeIs('products.*') ? 'text-green-600 dark:text-green-400' : 'text-gray-400 group-hover:text-green-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" /></svg>
                            Produk POC
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('inventory.index') }}" class="group relative flex items-center gap-3 rounded-lg px-4 py-2.5 font-medium text-sm transition-all duration-200 {{ request()->routeIs('inventory.*') ? 'bg-gradient-to-r from-green-50 to-emerald-50 dark:from-green-900/30 dark:to-emerald-900/20 text-green-700 dark:text-green-400 shadow-sm border border-green-200/60 dark:border-green-800/40' : 'text-gray-600 dark:text-gray-300 hover:bg-gray-50 hover:text-green-700 dark:hover:bg-gray-700/50 hover:translate-x-1' }}">
                            <svg class="w-5 h-5 {{ request()->routeIs('inventory.*') ? 'text-green-600 dark:text-green-400' : 'text-gray-400 group-hover:text-green-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                            Stok & Inventory
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('reports.index') }}" class="group relative flex items-center gap-3 rounded-lg px-4 py-2.5 font-medium text-sm transition-all duration-200 {{ request()->routeIs('reports.*') ? 'bg-gradient-to-r from-green-50 to-emerald-50 dark:from-green-900/30 dark:to-emerald-900/20 text-green-700 dark:text-green-400 shadow-sm border border-green-200/60 dark:border-green-800/40' : 'text-gray-600 dark:text-gray-300 hover:bg-gray-50 hover:text-green-700 dark:hover:bg-gray-700/50 hover:translate-x-1' }}">
                            <svg class="w-5 h-5 {{ request()->routeIs('reports.*') ? 'text-green-600 dark:text-green-400' : 'text-gray-400 group-hover:text-green-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" /></svg>
                            Laporan
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('settings.index') }}" class="group relative flex items-center gap-3 rounded-lg px-4 py-2.5 font-medium text-sm transition-all duration-200 {{ request()->routeIs('settings.*') ? 'bg-gradient-to-r from-green-50 to-emerald-50 dark:from-green-900/30 dark:to-emerald-900/20 text-green-700 dark:text-green-400 shadow-sm border border-green-200/60 dark:border-green-800/40' : 'text-gray-600 dark:text-gray-300 hover:bg-gray-50 hover:text-green-700 dark:hover:bg-gray-700/50 hover:translate-x-1' }}">
                            <svg class="w-5 h-5 {{ request()->routeIs('settings.*') ? 'text-green-600 dark:text-green-400' : 'text-gray-400 group-hover:text-green-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                            Pengaturan
                        </a>
                    </li>
                </ul>
                @endrole
            </div>
        </nav>
    </div>

    <!-- User Profile & Logout -->
    <div class="p-4 border-t border-gray-200/50 dark:border-gray-700/50 bg-gradient-to-r from-gray-50 to-white dark:from-gray-800/80 dark:to-gray-800/50 mt-auto">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-3 overflow-hidden">
                <span class="h-10 w-10 shrink-0 rounded-full bg-gradient-to-br from-green-400 to-emerald-600 text-white flex items-center justify-center font-bold shadow-md">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </span>
                <div class="flex flex-col overflow-hidden">
                    <span class="text-sm font-semibold text-gray-800 dark:text-gray-200 truncate">{{ Auth::user()->name }}</span>
                    <a href="{{ route('profile.edit') }}" class="text-xs text-green-600 hover:text-green-700 dark:text-green-400 dark:hover:text-green-300 truncate">Edit Profil</a>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}" class="shrink-0 ml-2">
                @csrf
                <button type="submit" class="p-2 text-gray-500 hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors dark:text-gray-400 dark:hover:text-red-400 dark:hover:bg-gray-700" title="Log Out">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" /></svg>
                </button>
            </form>
        </div>
    </div>
</aside>
<style>
.hide-scrollbar::-webkit-scrollbar {
  display: none;
}
.hide-scrollbar {
  -ms-overflow-style: none;
  scrollbar-width: none;
}
</style>
