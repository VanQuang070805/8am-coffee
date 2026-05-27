@extends('layouts.customer')
@section('title', 'Thực đơn — 8AM Coffee')

@push('head')
@if($maOrder)
<meta name="ma-order" content="{{ $maOrder }}">
@endif
@endpush

@section('content')
{{-- Category filter --}}
<div class="flex gap-2 overflow-x-auto pb-2 mb-4 scrollbar-hide">
    <button @click="activeCategory = null"
            :class="activeCategory === null ? 'bg-amber-500 text-white' : 'bg-white border border-gray-200 text-gray-600'"
            class="flex-shrink-0 px-4 py-1.5 rounded-full text-xs font-medium">
        Tất cả
    </button>
    @foreach($danhMucs as $dm)
    <button @click="activeCategory = '{{ $dm->ma_danh_muc }}'"
            :class="activeCategory === '{{ $dm->ma_danh_muc }}' ? 'bg-amber-500 text-white' : 'bg-white border border-gray-200 text-gray-600'"
            class="flex-shrink-0 px-4 py-1.5 rounded-full text-xs font-medium whitespace-nowrap">
        {{ $dm->ten_danh_muc }}
    </button>
    @endforeach
</div>

{{-- Menu items --}}
@foreach($danhMucs as $dm)
<section x-show="activeCategory === null || activeCategory === '{{ $dm->ma_danh_muc }}'" class="mb-6">
    <h2 class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-3">{{ $dm->ten_danh_muc }}</h2>
    <div class="space-y-2">
        @foreach($dm->mons as $mon)
        <x-menu-item-card :mon="$mon" :order="$maOrder" />
        @endforeach
    </div>
</section>
@endforeach
@endsection
