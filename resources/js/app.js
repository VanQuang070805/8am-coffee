import Alpine from 'alpinejs';
window.Alpine = Alpine;

// ── Cart store dùng cho layout customer ──────────────────────
document.addEventListener('alpine:init', () => {
    Alpine.data('cart', () => ({
        items: JSON.parse(localStorage.getItem('cart_items') || '[]'),
        openCart: false,
        activeCategory: null,
        checkoutError: '',

        get totalItems() {
            return this.items.reduce((sum, i) => sum + i.qty, 0);
        },

        get totalPrice() {
            return this.items.reduce((sum, i) => sum + i.don_gia * i.qty, 0);
        },

        get checkoutUrl() {
            const maOrder = document.querySelector('meta[name="ma-order"]')?.content;
            return maOrder ? `/order/${maOrder}/cart` : '#';
        },

        addToCart(mon) {
            const existing = this.items.find(i => i.ma_mon === mon.ma_mon);
            if (existing) {
                existing.qty++;
            } else {
                this.items.push({ ...mon, qty: 1 });
            }
            this.saveCart();
            this.openCart = true;
        },

        increment(ma_mon) {
            const item = this.items.find(i => i.ma_mon === ma_mon);
            if (item) { item.qty++; this.saveCart(); }
        },

        decrement(ma_mon) {
            const idx = this.items.findIndex(i => i.ma_mon === ma_mon);
            if (idx === -1) return;
            if (this.items[idx].qty > 1) {
                this.items[idx].qty--;
            } else {
                this.items.splice(idx, 1);
            }
            this.saveCart();
        },

        saveCart() {
            localStorage.setItem('cart_items', JSON.stringify(this.items));
        },

        formatPrice(price) {
            return new Intl.NumberFormat('vi-VN').format(price) + 'đ';
        },

        async checkout() {
            const maOrder = document.querySelector('meta[name="ma-order"]')?.content;
            const token = document.querySelector('meta[name="csrf-token"]')?.content;

            if (!maOrder) {
                this.checkoutError = 'Không tìm thấy mã đơn hàng.';
                return;
            }

            if (this.items.length === 0) {
                this.checkoutError = 'Giỏ hàng đang trống.';
                return;
            }

            this.checkoutError = '';

            try {
                for (const item of this.items) {
                    const response = await fetch(`/order/${maOrder}/item`, {
                        method: 'POST',
                        credentials: 'same-origin',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': token,
                        },
                        body: JSON.stringify({
                            ma_mon: item.ma_mon,
                            so_luong: item.qty,
                        }),
                    });

                    if (!response.ok) {
                        throw new Error('Không thể gửi món lên hệ thống.');
                    }
                }

                this.clearCart();
                window.location.href = `/order/${maOrder}/cart`;
            } catch (error) {
                this.checkoutError = error.message || 'Không thể gửi giỏ hàng.';
            }
        },

        clearCart() {
            this.items = [];
            localStorage.removeItem('cart_items');
        }
    }));
});

Alpine.start();
