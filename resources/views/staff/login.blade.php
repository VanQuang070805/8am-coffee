<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập — 8AM Coffee</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-stone-100 flex items-center justify-center min-h-screen">
<div class="w-full max-w-sm bg-white rounded-2xl border border-gray-200 p-8">
    <div class="text-center mb-8">
        <h1 class="text-xl font-semibold">8AM Coffee</h1>
        <p class="text-sm text-gray-400 mt-1">Đăng nhập hệ thống nhân viên</p>
    </div>

    @if($errors->any())
    <div class="bg-red-50 border border-red-200 text-red-600 rounded-xl px-4 py-3 text-sm mb-4">
        {{ $errors->first() }}
    </div>
    @endif

    <form method="POST" action="{{ route('login.post') }}" class="space-y-4">
        @csrf
        <div>
            <label class="block text-xs text-gray-500 mb-1">Tên đăng nhập</label>
            <input type="text" name="ten_tk" value="{{ old('ten_tk') }}" required
                   class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm
                          focus:outline-none focus:ring-2 focus:ring-amber-300">
        </div>
        <div>
            <label class="block text-xs text-gray-500 mb-1">Mật khẩu</label>
            <input type="password" name="mat_khau" required
                   class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm
                          focus:outline-none focus:ring-2 focus:ring-amber-300">
        </div>
        <button type="submit"
                class="w-full bg-amber-500 text-white rounded-xl py-2.5 text-sm font-medium mt-2">
            Đăng nhập
        </button>
    </form>
</div>
</body>
</html>
