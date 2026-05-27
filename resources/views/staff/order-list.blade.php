@extends('layouts.app')
@section('page-title', 'Quản lý đơn hàng')

@section('content')
{{-- Filter bar --}}
<div class="flex gap-2 mb-5">
    @foreach(['cho_xac_nhan' => 'Chờ xác nhận', 'da_xac_nhan' => 'Đã xác nhận', 'dang_pha_che' => 'Đang pha chế', 'da_phuc_vu' => 'Đã phục vụ'] as $val => $label)
    <a href="{{ request()->fullUrlWithQuery(['status' => $val]) }}"
       class="px-3 py-1.5 rounded-lg text-xs font-medium
              {{ request('status') === $val ? 'bg-amber-100 text-amber-800' : 'bg-white border border-gray-200 text-gray-600' }}">
        {{ $label }}
        <span class="ml-1 bg-gray-100 text-gray-500 px-1.5 py-0.5 rounded-full">
            {{ $counts[$val] ?? 0 }}
        </span>
    </a>
    @endforeach
</div>

{{-- Order cards grid --}}
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
    @forelse($orders as $order)
    <x-order-card :order="$order" />
    @empty
    <div class="col-span-3 text-center py-16 text-gray-400 text-sm">
        Không có đơn hàng nào
    </div>
    @endforelse
</div>

{{ $orders->links() }}
@endsection
