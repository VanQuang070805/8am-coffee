@extends('layouts.customer')
@section('title', 'Xác nhận đặt món')

@section('content')
<h1 class="text-lg font-semibold mb-4">Xác nhận đơn hàng</h1>

<div class="bg-white border border-gray-200 rounded-2xl p-4 mb-4 space-y-3">
    @foreach($order->chiTietOrders as $item)
    <div class="flex items-center justify-between">
        <div>
            <p class="text-sm font-medium">{{ $item->mon->ten_mon }}</p>
            @if($item->ghi_chu)
                <p class="text-xs text-gray-400">{{ $item->ghi_chu }}</p>
            @endif
        </div>
        <div class="text-right">
            <p class="text-sm">x{{ $item->so_luong }}</p>
            <p class="text-xs text-gray-500">
                {{ number_format($item->don_gia_tai_thoi_diem * $item->so_luong, 0, ',', '.') }}đ
            </p>
        </div>
    </div>
    @endforeach
    <div class="border-t border-gray-100 pt-3 flex justify-between font-medium">
        <span class="text-sm">Tổng cộng</span>
        <span class="text-sm text-amber-600">
            {{ number_format($order->chiTietOrders->sum(fn($i) => $i->don_gia_tai_thoi_diem * $i->so_luong), 0, ',', '.') }}đ
        </span>
    </div>
</div>

<form method="POST" action="{{ route('customer.confirm', $order->ma_order) }}">
    @csrf
    <button class="w-full bg-amber-500 text-white rounded-xl py-3 text-sm font-medium">
        Gửi đơn đặt món
    </button>
</form>
<a href="{{ route('customer.menu', ['ma_ban' => $order->ban->ma_ban, 'ma_order' => $order->ma_order]) }}"
   class="block text-center text-sm text-gray-400 mt-3">
    ← Quay lại menu
</a>
@endsection
