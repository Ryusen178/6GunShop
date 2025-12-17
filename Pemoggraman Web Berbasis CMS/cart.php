<?php include "header.php"; ?>

<div class="cart-container">
    <h2>Your Cart</h2>
    <table class="cart-table">
        <thead>
            <tr>
                <th>Item</th>
                <th>Price</th>
                <th>Qty</th>
                <th>Total</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody id="cart-body"></tbody>
    </table>
    <h3 id="grand-total"></h3>
</div>

<script>
    let cart = loadCart();
    let html = "";
    let grand = 0;

    cart.forEach((p, i) => {
        let total = p.price * p.qty;
        grand += total;
        html += `
        <tr>
            <td><img src="${p.img}" width="60"> ${p.name}</td>
            <td>$${p.price}</td>
            <td>
                <input type="number" value="${p.qty}" min="1"
                onchange="updateQty(${i}, this.value)">
            </td>
            <td>$${total}</td>
            <td><button onclick="removeCart(${i})">Remove</button></td>
        </tr>`;
    });

    document.getElementById("cart-body").innerHTML = html;
    document.getElementById("grand-total").innerText = `Grand Total: $${grand}`;
</script>

<?php include "footer.php"; ?>

