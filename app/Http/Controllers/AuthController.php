<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (session('tai_khoan_id')) {
            return redirect()->route('dashboard');
        }
        return view('staff.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'ten_tk'   => 'required|string',
            'mat_khau' => 'required|string',
        ], [
            'ten_tk.required'   => 'Vui lòng nhập tên đăng nhập.',
            'mat_khau.required' => 'Vui lòng nhập mật khẩu.',
        ]);

        $taiKhoan = DB::table('TAI_KHOAN')
            ->join('NHAN_VIEN', 'TAI_KHOAN.ma_nv', '=', 'NHAN_VIEN.ma_nv')
            ->where('TAI_KHOAN.ten_tk', $request->ten_tk)
            ->where('TAI_KHOAN.trang_thai', 'active')
            ->select('TAI_KHOAN.*', 'NHAN_VIEN.ten_nv', 'NHAN_VIEN.ma_chi_nhanh')
            ->first();

        if (!$taiKhoan || !Hash::check($request->mat_khau, $taiKhoan->mat_khau)) {
            return back()->withErrors(['ten_tk' => 'Tên đăng nhập hoặc mật khẩu không đúng.'])
                         ->withInput($request->only('ten_tk'));
        }

        $request->session()->regenerate();
        session([
            'tai_khoan_id' => $taiKhoan->ma_tai_khoan,
            'ma_nv'        => $taiKhoan->ma_nv,
            'ten_nv'       => $taiKhoan->ten_nv,
            'chuc_vu'      => $taiKhoan->chuc_vu,
            'ma_chi_nhanh' => $taiKhoan->ma_chi_nhanh,
        ]);

        return redirect()->intended(route('dashboard'));
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        return redirect()->route('login');
    }
}
