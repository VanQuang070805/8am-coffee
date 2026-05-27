@props(['order'])
<div class="bg-white rounded-xl border border-gray-200 p-4 flex flex-col gap-3">
    <div class="flex items-start justify-between">
        <div>
            <p class="text-sm font-medium">Bàn {{ $order->ban->so_ban }}</p>
            <p class="text-xs text-gray-400">{{ $order->gio_order->format('H:i') }}</p>
        </div>
        <x-order-status-badge :status="$order->trang_thai" />
    </div>
    <div class="text-xs text-gray-500 space-y-0.5">
        @foreach($order->chiTietOrders->take(3) as $item)
        <p>{{ $item->mon->ten_mon }} ×{{ $item->so_luong }}</p>
        @endforeach
        @if($order->chiTietOrders->count() > 3)
        <p class="text-gray-400">+ {{ $order->chiTietOrders->count() - 3 }} món khác</p>
        @endif
    </div>
    <div class="flex gap-2 pt-1">
        <a href="{{ route('orders.show', $order->ma_order) }}"
           class="flex-1 text-center text-xs border border-gray-200 rounded-lg py-1.5 text-gray-600">
            Chi tiết
        </a>
        @if($order->trang_thai === 'cho_xac_nhan')
        <form method="POST" action="{{ route('orders.confirm', $order->ma_order) }}" class="flex-1">
            @csrf @method('PUT')
            <button class="w-full text-xs bg-amber-500 text-white rounded-lg py-1.5">
                Xác nhận
            </button>
        </form>
        @endif
        @if(in_array($order->trang_thai, ['da_xac_nhan','dang_pha_che','da_phuc_vu']))
        <a href="{{ route('payment.show', $order->ma_order) }}"
           class="flex-1 text-center text-xs bg-green-500 text-white rounded-lg py-1.5">
            Thanh toán
        </a>
        @endif
    </div>
</div>
