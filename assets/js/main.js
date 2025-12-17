// Quick View modal dynamic creation & filter/sort behavior
document.addEventListener("click", (e) => {
    // Quick View button (data attributes expected)
    if (e.target.matches(".quick-view-btn")) {
      e.preventDefault();
      const id = e.target.dataset.id;
      const title = e.target.dataset.title;
      const img = e.target.dataset.img;
      const price = e.target.dataset.price;
      showQuickView({id,title,img,price});
    }
  });
  
  // Show quick view
  function showQuickView(prod){
    // Create modal
    const modal = document.createElement("div");
    modal.className = "quick-modal";
    modal.innerHTML = `
      <div class="quick-modal-inner">
        <button class="close-quick">✕</button>
        <div class="quick-left"><img src="${prod.img}" alt="${prod.title}" /></div>
        <div class="quick-right">
          <h3>${prod.title}</h3>
          <p class="price">${prod.price}</p>
          <p>Short specs: 9mm • 15 rounds • Polymer frame</p>
          <div class="actions">
            <button class="btn" onclick='addToCart({id:"${prod.id}", title:"${prod.title}", price:"${prod.price}"})'>Add to Cart</button>
            <button class="btn" onclick='toggleWishlist("${prod.id}")'>♡ Wishlist</button>
          </div>
        </div>
      </div>`;
    document.body.appendChild(modal);
    modal.querySelector(".close-quick").onclick = ()=> modal.remove();
    modal.addEventListener("click", (ev)=> { if(ev.target === modal) modal.remove(); });
  }
  
  // Filter & Sort (client side assuming product cards have data attributes)
  document.addEventListener("change", (e)=>{
    if (e.target.matches(".filter-sort")) {
      applyFilterSort();
    }
  });
  
  function applyFilterSort() {
    const sort = document.querySelector("#sort-select")?.value || "";
    const caliber = document.querySelector("#caliber-select")?.value || "";
    let cards = Array.from(document.querySelectorAll(".product-card"));
    // filter by caliber
    if (caliber) {
      cards.forEach(c => {
        const cals = (c.dataset.caliber||"").toLowerCase();
        c.style.display = cals.includes(caliber.toLowerCase()) ? "" : "none";
      });
    } else {
      cards.forEach(c => c.style.display = "");
    }
    // sort (low-high, high-low)
    if (sort) {
      const parent = document.querySelector(".product-grid");
      const visible = cards.filter(c => c.style.display !== "none");
      visible.sort((a,b) => {
        const pa = parseFloat(a.dataset.price || "0");
        const pb = parseFloat(b.dataset.price || "0");
        if (sort === "low") return pa - pb;
        if (sort === "high") return pb - pa;
        return 0;
      });
      visible.forEach(n => parent.appendChild(n));
    }
  }
  