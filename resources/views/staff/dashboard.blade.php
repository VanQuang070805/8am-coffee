@extends('layouts.app')

@section('title', 'Dashboard - 8AM Coffee')
@section('page-title', 'Dashboard')

@section('content')
<div class="max-w-7xl">
    <h2 class="text-2xl font-semibold text-gray-800 mb-6">Tổng quan hôm nay</h2>

    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4 mb-8">
        <div class="bg-white rounded-xl shadow-sm p-4 border border-gray-100">
            <p class="text-xs text-gray-500 mb-1">Order hôm nay</p>
            <p class="text-3xl font-bold text-gray-800">{{ $orderHomNay }}</p>
        </div>
        <div class="bg-amber-50 rounded-xl shadow-sm p-4 border border-amber-100">
            <p class="text-xs text-amber-600 mb-1">Chờ xác nhận</p>
            <p class="text-3xl font-bold text-amber-700">{{ $orderChoXacNhan }}</p>
        </div>
        <div class="bg-blue-50 rounded-xl shadow-sm p-4 border border-blue-100">
            <p class="text-xs text-blue-600 mb-1">Đang pha chế</p>
            <p class="text-3xl font-bold text-blue-700">{{ $orderDangPhaChe }}</p>
        </div>
        <div class="bg-green-50 rounded-xl shadow-sm p-4 border border-green-100">
            <p class="text-xs text-green-600 mb-1">Doanh thu</p>
            <p class="text-2xl font-bold text-green-700">{{ number_format($doanhThuHomNay, 0, ',', '.') }}đ</p>
        </div>
        <div class="bg-purple-50 rounded-xl shadow-sm p-4 border border-purple-100">
            <p class="text-xs text-purple-600 mb-1">Bàn có khách</p>
            <p class="text-3xl font-bold text-purple-700">
                {{ $banCoKhach }}<span class="text-base font-normal text-purple-400">/{{ $tongBan }}</span>
            </p>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100">
        <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
            <h3 class="font-semibold text-gray-700">Order cần xử lý</h3>
            <a href="{{ route('orders.index') }}" class="text-sm text-amber-600 hover:underline">Xem tất cả</a>
        </div>
        <div class="divide-y divide-gray-50">
            @forelse($orderGanDay as $order)
            <div class="flex items-center justify-between px-6 py-3">
                <div>
                    <span class="font-mono text-sm text-gray-600">{{ $order->ma_order }}</span>
                    <span class="ml-2 text-sm text-gray-500">Bàn {{ $order->ban->so_ban ?? '?' }}</span>
                    <span class="ml-2 text-sm text-gray-400">{{ $order->khachHang->ten_kh ?? 'Khách' }}</span>
                </div>
                <div class="flex items-center gap-3">
                    <x-order-status-badge :status="$order->trang_thai" />
                    <a href="{{ route('orders.show', $order->ma_order) }}"
                       class="text-xs bg-gray-100 hover:bg-gray-200 text-gray-600 px-3 py-1 rounded-lg transition">
                        Chi tiết
                    </a>
                </div>
            </div>
            @empty
            <div class="px-6 py-8 text-center text-gray-400 text-sm">Không có order nào cần xử lý.</div>
            @endforelse
        </div>
    </div>
</div>
@endsection
