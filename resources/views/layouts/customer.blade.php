<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', '8AM Coffee — Đặt món')</title>
    @stack('head')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-stone-50 text-gray-800 min-h-screen" x-data="cart()">

<header class="sticky top-0 bg-white border-b border-gray-200 z-40">
    <div class="max-w-md mx-auto flex items-center justify-between px-4 h-14">
        <span class="font-semibold text-base">8AM Coffee</span>
        {{-- Cart badge --}}
        <button @click="openCart = true" class="relative p-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
            </svg>
            <span x-show="totalItems > 0"
                  x-text="totalItems"
                  class="absolute -top-1 -right-1 w-5 h-5 bg-amber-500 text-white text-xs
                         rounded-full flex items-center justify-center font-medium">
            </span>
        </button>
    </div>
</header>

<main class="max-w-md mx-auto px-4 py-4">
    @yield('content')
</main>

{{-- Cart Drawer (Alpine.js) --}}
<div x-show="openCart" class="fixed inset-0 z-50 flex justify-end"
     x-transition:enter="transition ease-out duration-200"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100">
    <div @click="openCart = false" class="absolute inset-0 bg-black bg-opacity-40"></div>
    <div class="relative w-80 bg-white h-full overflow-y-auto p-5 shadow-xl">
        <div class="flex items-center justify-between mb-4">
            <h2 class="font-medium text-base">Giỏ hàng</h2>
            <button @click="openCart = false">
                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
        <template x-if="items.length === 0">
            <p class="text-sm text-gray-400 text-center py-8">Chưa có món nào</p>
        </template>
        <template x-for="item in items" :key="item.ma_mon">
            <div class="flex items-center justify-between py-3 border-b border-gray-100">
                <div>
                    <p class="text-sm font-medium" x-text="item.ten_mon"></p>
                    <p class="text-xs text-gray-500" x-text="formatPrice(item.don_gia)"></p>
                </div>
                <div class="flex items-center gap-2">
                    <button @click="decrement(item.ma_mon)" class="w-6 h-6 rounded-full border border-gray-300 text-gray-500 flex items-center justify-center text-sm">-</button>
                    <span class="text-sm w-5 text-center" x-text="item.qty"></span>
                    <button @click="increment(item.ma_mon)" class="w-6 h-6 rounded-full border border-gray-300 text-gray-500 flex items-center justify-center text-sm">+</button>
                </div>
            </div>
        </template>
        <div x-show="items.length > 0" class="mt-4">
            <div class="flex justify-between text-sm font-medium mb-4">
                <span>Tổng cộng</span>
                <span x-text="formatPrice(totalPrice)"></span>
            </div>
            <p x-show="checkoutError" x-text="checkoutError" class="text-xs text-red-500 mb-3"></p>
            <button type="button" @click="checkout()"
                    class="block w-full text-center bg-amber-500 text-white py-3 rounded-xl text-sm font-medium">
                Đặt món
            </button>
        </div>
    </div>
</div>

</body>
</html>
