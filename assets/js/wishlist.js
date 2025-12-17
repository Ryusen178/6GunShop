const WISH_KEY = "6gunshop_wishlist";
function getWishlist(){ return JSON.parse(localStorage.getItem(WISH_KEY) || "[]"); }
function saveWishlist(w){ localStorage.setItem(WISH_KEY, JSON.stringify(w)); updateWishCount(); }
function toggleWishlist(itemId) {
  const w = getWishlist();
  const idx = w.indexOf(itemId);
  if(idx > -1) { w.splice(idx,1); toast("Removed from wishlist"); }
  else { w.push(itemId); toast("Added to wishlist"); }
  saveWishlist(w);
}
function updateWishCount(){
  const el = document.getElementById("wish-count");
  if(el) el.textContent = getWishlist().length;
}
window.toggleWishlist = toggleWishlist;
document.addEventListener("DOMContentLoaded", updateWishCount);
