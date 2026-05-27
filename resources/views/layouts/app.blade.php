<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', '8AM Coffee - Staff') </title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 text-gray-800" x-data>

{{-- Sidebar --}}
<aside class="fixed inset-y-0 left-0 w-56 bg-white border-r border-gray-200 flex flex-col">
    <div class="h-16 flex items-center px-5 border-b border-gray-100">
        <span class="font-semibold text-base text-gray-900">8AM Coffee</span>
    </div>
    <nav class="flex-1 py-4 px-3 space-y-1">
        <a href="{{ route('dashboard') }}"
           class="flex items-center gap-2 px-3 py-2 rounded-lg text-sm
                  {{ request()->routeIs('dashboard') ? 'bg-amber-50 text-amber-700 font-medium' : 'text-gray-600 hover:bg-gray-50' }}">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
            Dashboard
        </a>
        <a href="{{ route('orders.index') }}"
           class="flex items-center gap-2 px-3 py-2 rounded-lg text-sm
                  {{ request()->routeIs('orders.*') ? 'bg-amber-50 text-amber-700 font-medium' : 'text-gray-600 hover:bg-gray-50' }}">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
            Đơn hàng
        </a>
        <a href="{{ route('inventory.index') }}"
           class="flex items-center gap-2 px-3 py-2 rounded-lg text-sm
                  {{ request()->routeIs('inventory.*') ? 'bg-amber-50 text-amber-700 font-medium' : 'text-gray-600 hover:bg-gray-50' }}">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
            Kho hàng
        </a>
        @if(session('chuc_vu') === 'quan_ly')
        <a href="{{ route('menu.index') }}"
           class="flex items-center gap-2 px-3 py-2 rounded-lg text-sm
                  {{ request()->routeIs('menu.*') ? 'bg-amber-50 text-amber-700 font-medium' : 'text-gray-600 hover:bg-gray-50' }}">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            Thực đơn
        </a>
        @endif
    </nav>
    <div class="p-4 border-t border-gray-100">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="w-full text-left text-sm text-gray-500 hover:text-gray-800 px-3 py-2">
                Đăng xuất
            </button>
        </form>
    </div>
</aside>

{{-- Main content --}}
<main class="ml-56 min-h-screen">
    <header class="h-16 bg-white border-b border-gray-200 flex items-center px-6">
        <h1 class="text-base font-medium text-gray-900">@yield('page-title', 'Dashboard')</h1>
        <div class="ml-auto flex items-center gap-3">
            <span class="text-sm text-gray-500">{{ session('ten_nv', 'Nhân viên') }}</span>
            <span class="text-xs px-2 py-1 rounded-full bg-amber-50 text-amber-700">
                {{ session('chuc_vu', '') }}
            </span>
        </div>
    </header>
    <div class="p-6">
        @if(session('success'))
            <x-alert-toast type="success" :message="session('success')" />
        @endif
        @if(session('error'))
            <x-alert-toast type="error" :message="session('error')" />
        @endif
        @yield('content')
    </div>
</main>

</body>
</html>
