@extends('layouts.app')

@section('title', 'Thực đơn - 8AM Coffee')
@section('page-title', 'Quản lý thực đơn')

@section('content')
<div class="max-w-6xl">
    <div class="flex items-center justify-between mb-5">
        <div class="flex gap-2 overflow-x-auto">
            <a href="{{ route('menu.index') }}"
               class="px-3 py-1.5 rounded-lg text-xs font-medium {{ request('category') ? 'bg-white border border-gray-200 text-gray-600' : 'bg-amber-100 text-amber-800' }}">
                Tất cả
            </a>
            @foreach($danhMucs as $danhMuc)
            <a href="{{ route('menu.index', ['category' => $danhMuc->ma_danh_muc]) }}"
               class="px-3 py-1.5 rounded-lg text-xs font-medium bg-white border border-gray-200 text-gray-600">
                {{ $danhMuc->ten_danh_muc }}
            </a>
            @endforeach
        </div>
        <a href="{{ route('menu.create') }}"
           class="bg-amber-500 hover:bg-amber-600 text-white text-sm font-medium px-4 py-2 rounded-xl transition">
            + Thêm món
        </a>
    </div>

    <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
        <table class="w-full text-sm">
            <thead>
                <tr class="border-b border-gray-100">
                    <th class="text-left px-4 py-3 text-xs text-gray-400 font-medium">Mã món</th>
                    <th class="text-left px-4 py-3 text-xs text-gray-400 font-medium">Tên món</th>
                    <th class="text-left px-4 py-3 text-xs text-gray-400 font-medium">Danh mục</th>
                    <th class="text-right px-4 py-3 text-xs text-gray-400 font-medium">Giá</th>
                    <th class="text-center px-4 py-3 text-xs text-gray-400 font-medium">Trạng thái</th>
                    <th class="px-4 py-3"></th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse($mons as $mon)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-3 font-mono text-xs text-gray-500">{{ $mon->ma_mon }}</td>
                    <td class="px-4 py-3">
                        <p class="font-medium text-gray-800">{{ $mon->ten_mon }}</p>
                        @if($mon->mo_ta)
                        <p class="text-xs text-gray-400 line-clamp-1">{{ $mon->mo_ta }}</p>
                        @endif
                    </td>
                    <td class="px-4 py-3 text-gray-600">{{ $mon->danhMuc->ten_danh_muc ?? '—' }}</td>
                    <td class="px-4 py-3 text-right">{{ number_format($mon->don_gia, 0, ',', '.') }}đ</td>
                    <td class="px-4 py-3 text-center">
                        <span class="text-xs px-2 py-0.5 rounded-full
                            {{ $mon->trang_thai === 'active' ? 'bg-green-50 text-green-700' : '' }}
                            {{ $mon->trang_thai === 'het_hang' ? 'bg-yellow-50 text-yellow-700' : '' }}
                            {{ $mon->trang_thai === 'an' ? 'bg-gray-100 text-gray-500' : '' }}">
                            {{ ['active' => 'Đang bán', 'het_hang' => 'Hết hàng', 'an' => 'Ẩn'][$mon->trang_thai] ?? $mon->trang_thai }}
                        </span>
                    </td>
                    <td class="px-4 py-3 text-right">
                        <a href="{{ route('menu.edit', $mon->ma_mon) }}" class="text-xs text-blue-500 hover:underline mr-3">Sửa</a>
                        <form action="{{ route('menu.destroy', $mon->ma_mon) }}" method="POST" class="inline"
                              onsubmit="return confirm('Ẩn món này khỏi thực đơn?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-xs text-red-400 hover:underline">Ẩn</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" class="px-4 py-8 text-center text-gray-400">Chưa có món nào.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">{{ $mons->links() }}</div>
</div>
@endsection
