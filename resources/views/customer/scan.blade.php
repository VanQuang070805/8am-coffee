@extends('layouts.customer')
@section('title', 'Chào mừng — Bàn ' . $ban->so_ban)

@section('content')
<div class="flex flex-col items-center justify-center min-h-[60vh] text-center">
    <div class="w-16 h-16 bg-amber-50 rounded-2xl flex items-center justify-center mb-4">
        <svg class="w-8 h-8 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/>
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/>
        </svg>
    </div>
    <h1 class="text-xl font-semibold mb-1">Xin chào!</h1>
    <p class="text-sm text-gray-500 mb-6">Bàn {{ $ban->so_ban }} — {{ $ban->vi_tri }}</p>

    <form method="POST" action="{{ route('customer.create', $ban->ma_ban) }}" class="w-full max-w-xs space-y-3">
        @csrf
        <input type="text" name="ten_kh" placeholder="Tên của bạn (tuỳ chọn)"
               class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-amber-300">
        <input type="text" name="sdt_kh" placeholder="Số điện thoại (tuỳ chọn)"
               class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-amber-300">
        <button type="submit"
                class="w-full bg-amber-500 text-white rounded-xl py-3 text-sm font-medium">
            Xem thực đơn
        </button>
    </form>
</div>
@endsection
