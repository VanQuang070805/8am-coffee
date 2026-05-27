@extends('layouts.customer')

@section('title', 'Trạng thái đơn hàng')

@section('content')
<div class="max-w-md mx-auto px-4 py-10 text-center">
    @if(session('info'))
    <div class="mb-5 bg-blue-50 border border-blue-100 text-blue-700 rounded-xl px-4 py-3 text-sm">
        {{ session('info') }}
    </div>
    @endif

    <div class="mb-6">
        @if($order->trang_thai === 'cho_xac_nhan')
            <div class="text-5xl mb-3">⏳</div>
            <h1 class="text-xl font-semibold text-gray-800">Đơn đang chờ xác nhận</h1>
            <p class="text-gray-500 text-sm mt-2">Nhân viên sẽ xác nhận đơn của bạn trong giây lát.</p>
        @elseif($order->trang_thai === 'da_xac_nhan')
            <div class="text-5xl mb-3">✅</div>
            <h1 class="text-xl font-semibold text-gray-800">Đơn đã được xác nhận</h1>
            <p class="text-gray-500 text-sm mt-2">Đơn hàng của bạn đã được tiếp nhận.</p>
        @elseif($order->trang_thai === 'dang_pha_che')
            <div class="text-5xl mb-3">☕</div>
            <h1 class="text-xl font-semibold text-gray-800">Đang pha chế</h1>
            <p class="text-gray-500 text-sm mt-2">Bartender đang chuẩn bị đồ uống cho bạn.</p>
        @elseif($order->trang_thai === 'da_phuc_vu')
            <div class="text-5xl mb-3">🎉</div>
            <h1 class="text-xl font-semibold text-gray-800">Đã phục vụ</h1>
            <p class="text-gray-500 text-sm mt-2">Chúc bạn ngon miệng. Cảm ơn đã đến 8AM Coffee.</p>
        @elseif($order->trang_thai === 'da_huy')
            <div class="text-5xl mb-3">❌</div>
            <h1 class="text-xl font-semibold text-gray-800">Đơn đã bị hủy</h1>
            <p class="text-gray-500 text-sm mt-2">Vui lòng liên hệ nhân viên để được hỗ trợ.</p>
        @else
            <div class="text-5xl mb-3">📋</div>
            <h1 class="text-xl font-semibold text-gray-800">Trạng thái: {{ $order->trang_thai }}</h1>
        @endif
    </div>

    <div class="bg-gray-50 rounded-xl p-4 text-left text-sm text-gray-600 mb-6">
        <p><span class="font-medium">Mã đơn:</span> <span class="font-mono">{{ $order->ma_order }}</span></p>
    </div>

    @if(!in_array($order->trang_thai, ['da_phuc_vu', 'hoan_thanh', 'da_huy']))
    <p class="text-xs text-gray-400 mb-4">Trang sẽ tự cập nhật sau 10 giây...</p>
    <meta http-equiv="refresh" content="10">
    @endif
</div>
@endsection
