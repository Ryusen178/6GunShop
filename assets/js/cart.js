// Gunakan satu nama kunci yang konsisten
const CART_KEY = "6gunshop_cart";

// 1. Fungsi Tambah ke Keranjang
function addToCart(id, name, price, img) {
    let cart = JSON.parse(localStorage.getItem(CART_KEY)) || [];

    // Pastikan ID diperlakukan sebagai string/number yang konsisten
    let item = cart.find(p => p.id === id);

    if (item) {
        item.qty++;
    } else {
        cart.push({ 
            id: id, 
            name: name, 
            price: parseFloat(price), // Pastikan harga adalah angka
            img: img, 
            qty: 1 
        });
    }

    localStorage.setItem(CART_KEY, JSON.stringify(cart));
    
    // Update angka badge di navbar secara instan
    updateCartCount();
    
    alert(`${name} has been added to your armory!`);
}

// 2. Fungsi Ambil Data (Untuk halaman cart.html)
function loadCart() {
    return JSON.parse(localStorage.getItem(CART_KEY)) || [];
}

// 3. Fungsi Update Jumlah (Qty)
function updateQty(index, newQty) {
    let cart = loadCart();
    if (cart[index]) {
        cart[index].qty = parseInt(newQty);
        // Jika user input 0 atau kurang, hapus item
        if (cart[index].qty <= 0) {
            return removeCart(index);
        }
        localStorage.setItem(CART_KEY, JSON.stringify(cart));
    }
    updateCartCount();
}

// 4. Fungsi Hapus Barang
function removeCart(index) {
    let cart = loadCart();
    cart.splice(index, 1);
    localStorage.setItem(CART_KEY, JSON.stringify(cart));
    updateCartCount();
}

// 5. Fungsi Update Badge Angka di Navbar
function updateCartCount() {
    const cart = loadCart();
    const totalQty = cart.reduce((total, item) => total + item.qty, 0);
    const badge = document.getElementById('cart-count');
    if (badge) {
        badge.textContent = totalQty;
    }
}

// Jalankan saat halaman di-load agar angka keranjang muncul
document.addEventListener("DOMContentLoaded", updateCartCount);
