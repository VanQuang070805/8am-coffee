<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderRequest;
use App\Services\OrderService;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct(private OrderService $orderService) {}

    /** Màn hình dashboard order cho nhân viên */
    public function index(Request $request)
    {
        $status = $request->get('status', 'cho_xac_nhan');
        $maChiNhanh = session('ma_chi_nhanh');

        $orders = Order::with(['ban', 'chiTietOrders.mon', 'khachHang'])
            ->where('ma_chi_nhanh', $maChiNhanh)
            ->where('trang_thai', $status)
            ->orderByDesc('ngay_order')
            ->orderByDesc('gio_order')
            ->paginate(12);

        $counts = $this->orderService->countByStatus($maChiNhanh);

        return view('staff.order-list', compact('orders', 'counts', 'status'));
    }

    /** Khách tạo order qua QR */
    public function createFromQr(StoreOrderRequest $request, string $maBan)
    {
        $result = $this->orderService->createOrder(
            maBan:      $maBan,
            tenKh:      $request->ten_kh ?: 'Khách',
            sdtKh:      $request->sdt_kh,
            maChiNhanh: \App\Models\Ban::findOrFail($maBan)->ma_chi_nhanh,
        );

        return redirect()->route('customer.menu', [
            'ma_ban'   => $maBan,
            'ma_order' => $result['ma_order'],
        ]);
    }

    /** Nhân viên xác nhận order (trigger DB sẽ trừ kho) */
    public function confirm(string $maOrder)
    {
        $this->orderService->confirm($maOrder);
        return back()->with('success', 'Đã xác nhận đơn hàng.');
    }

    /** Cập nhật trạng thái: dang_pha_che / da_phuc_vu */
    public function updateStatus(Request $request, string $maOrder)
    {
        $request->validate(['trang_thai' => 'required|in:dang_pha_che,da_phuc_vu,da_huy']);
        $this->orderService->updateStatus($maOrder, $request->trang_thai);
        return back()->with('success', 'Cập nhật trạng thái thành công.');
    }

    public function show(string $maOrder)
    {
        $order = Order::with(['ban', 'chiTietOrders.mon', 'khachHang'])->findOrFail($maOrder);
        return view('staff.order-detail', compact('order'));
    }

    public function merge(Request $request, string $maOrder)
    {
        $request->validate(['target_order' => 'required|string']);
        $this->orderService->merge($maOrder, $request->target_order);
        return back()->with('success', 'Đã gộp đơn hàng.');
    }

    public function split(Request $request, string $maOrder)
    {
        $request->validate([
            'ma_mon' => 'required|string',
            'so_luong_tach' => 'required|integer|min:1',
        ]);

        try {
            $maOrderMoi = $this->orderService->split(
                $maOrder,
                $request->ma_mon,
                (int) $request->so_luong_tach
            );

            return back()->with('success', "Đã tách thành order mới: {$maOrderMoi}");
        } catch (\InvalidArgumentException $e) {
            return back()->withErrors(['split' => $e->getMessage()]);
        }
    }

    public function addItem(Request $request, string $maOrder)
    {
        $request->validate(['ma_mon' => 'required', 'so_luong' => 'required|integer|min:1']);
        $this->orderService->addItem($maOrder, $request->ma_mon, $request->so_luong);
        return back();
    }

    public function removeItem(string $maOrder, string $maMon)
    {
        $this->orderService->removeItem($maOrder, $maMon);
        return back();
    }

    public function showCart(string $maOrder)
    {
        $order = Order::with(['ban', 'chiTietOrders.mon'])->findOrFail($maOrder);
        return view('customer.checkout', compact('order'));
    }

    public function confirmByCustomer(string $maOrder)
    {
        $order = Order::where('ma_order', $maOrder)
            ->where('trang_thai', 'cho_xac_nhan')
            ->first();

        if (!$order) {
            return redirect()->route('customer.status', $maOrder);
        }

        return redirect()->route('customer.status', $maOrder)
            ->with('info', 'Đơn hàng đã được gửi đến quầy. Vui lòng chờ xác nhận từ nhân viên.');
    }

    public function status(string $maOrder)
    {
        $order = Order::findOrFail($maOrder);
        return view('customer.status', compact('order'));
    }
}
