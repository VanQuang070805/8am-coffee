@props(['mon', 'order'])
<div class="flex items-center justify-between bg-white rounded-xl border border-gray-100 p-3">
    <div class="flex-1 mr-3">
        <p class="text-sm font-medium">{{ $mon->ten_mon }}</p>
        @if($mon->mo_ta)
            <p class="text-xs text-gray-400 mt-0.5 line-clamp-1">{{ $mon->mo_ta }}</p>
        @endif
        <p class="text-sm font-medium text-amber-600 mt-1">
            {{ number_format($mon->don_gia, 0, ',', '.') }}đ
        </p>
    </div>
    <button @click="addToCart({
                ma_mon: '{{ $mon->ma_mon }}',
                ten_mon: '{{ addslashes($mon->ten_mon) }}',
                don_gia: {{ $mon->don_gia }}
            })"
            class="flex-shrink-0 w-8 h-8 bg-amber-500 text-white rounded-full
                   flex items-center justify-center text-lg font-light">
        +
    </button>
</div>
