<?php include 'includes/header.php'; ?>

<div class="category-hero">
  <h1>Your Wishlist</h1>
  <p>Items you saved for later.</p>
</div>

<section style="padding:40px 6%;">
  <div id="wish-container"></div>
</section>

<script>
function renderWish(){
  const w = getWishlist();
  const container = document.getElementById("wish-container");
  container.innerHTML = "";
  if(w.length === 0) {
    container.innerHTML = "<p>Wishlist kosong.</p>";
    return;
  }
  // For demo, we only show id. In real app, you'd have product DB to query details.
  w.forEach(id=>{
    const el = document.createElement("div");
    el.style.padding="12px"; el.style.background="#0f0f0f"; el.style.marginBottom="8px"; el.style.borderRadius="8px";
    el.innerHTML = `<strong>${id}</strong> <button onclick='toggleWishlist("${id}")'>Remove</button>`;
    container.appendChild(el);
  });
}
document.addEventListener("DOMContentLoaded", renderWish);
window.addEventListener("storage", renderWish);
const oldSet = localStorage.setItem;
localStorage.setItem = function(k,v){
  oldSet.apply(this, arguments);
  if(k === "6gunshop_wishlist") renderWish();
};
</script>

<?php include 'includes/footer.php'; ?>
