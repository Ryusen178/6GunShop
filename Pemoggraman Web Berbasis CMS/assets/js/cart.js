// assets/js/cart.js

function addToCart(id, name, price, img) {
    let cart = JSON.parse(localStorage.getItem("cart")) || [];

    // cek jika produk sudah ada → tambah qty
    let item = cart.find(p => p.id === id);
    if (item) {
        item.qty++;
    } else {
        cart.push({ id, name, price, img, qty: 1 });
    }

    localStorage.setItem("cart", JSON.stringify(cart));
    alert(`${name} added to cart!`);
}

function loadCart() {
    return JSON.parse(localStorage.getItem("cart")) || [];
}

function removeCart(index) {
    let cart = loadCart();
    cart.splice(index, 1);
    localStorage.setItem("cart", JSON.stringify(cart));
    location.reload();
}

function updateQty(index, qty) {
    let cart = loadCart();
    cart[index].qty = qty;
    localStorage.setItem("cart", JSON.stringify(cart));
    location.reload();
}
