<script>
    /* -------------------------------
  Helpers: formatting & safe getters
------------------------------- */
    function formatPrice(v) {
        if (v === undefined || v === null) return "0";
        return Number(v).toLocaleString();
    }

    function safeStock(p) {
        return Number(p.stock ?? p.quantity ?? p.qty ?? 0);
    }

    function safePrice(p) {
        return Number(p.price ?? p.unit_price ?? p.buy_price ?? 0);
    }

    function safeName(p) {
        return p.name ?? p.title ?? "Unnamed product";
    }

    function truncate(str, max = 30) {
        if (!str) return "";
        return str.length > max ? str.substring(0, max - 1) + "…" : str;
    }

    /* -------------------------------
      Renderers used by controller
    ------------------------------- */
    function productCard(p) {
        const stock = safeStock(p);
        const price = safePrice(p);
        const name = safeName(p);

        // Color by stock level
        let stockBadge = "text-green-700";
        if (stock <= 0) stockBadge = "text-red-600 font-bold";
        else if (stock <= 5) stockBadge = "text-yellow-600";

        return `
    <div class="product-card bg-white rounded-2xl shadow p-4 hover:shadow-md transition-all flex flex-col justify-between h-full">
      <div>
        <div class="flex items-center justify-between mb-3">
          <div class="flex items-center gap-3">
            <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center">
              <i class="fas fa-box text-green-600"></i>
            </div>
            <div>
              <h3 class="font-medium text-sm text-gray-800" title="${name}">${truncate(name, 36)}</h3>
            </div>
          </div>
          <div class="text-right">
            <span class="text-xs text-gray-500 block">Stock</span>
            <p class="${stockBadge} text-lg">${stock}</p>
          </div>
        </div>

        <div class="mb-3">
          <p class="text-gray-900 font-bold text-md">${formatPrice(price)} Tsh</p>
        </div>
      </div>

      <div class="mt-2">
        <button data-id="${p.id ?? ''}" class="add-btn w-full py-2 rounded-xl bg-green-600 text-white hover:bg-green-700 transition-colors">
          <i class="fas fa-plus mr-2"></i> Add to Batch
        </button>
      </div>
    </div>
  `;
    }

    function cartItemRow(item) {
        // item must have id, name, qty, price, sku
        const name = item.name ?? "Item";
        const qty = item.qty ?? item.quantity ?? 1;
        const price = item.price ?? item.unit_amount ?? 0;
        const sku = item.sku ?? "-";
        const total = qty * price;

        return `
    <div class="cart-row flex justify-between items-center my-3 bg-gray-50 p-3 rounded-lg">
      <div class="flex-1 min-w-0">
        <p class="font-medium text-sm truncate" title="${name}">${truncate(name, 28)}</p>
        <p class="text-xs text-gray-600 mt-1">${formatPrice(price)} Tsh × ${qty} = <strong>${formatPrice(total)} Tsh</strong></p>
      </div>

      <div class="flex gap-2 ml-3">
        <button data-action="minus" data-id="${item.id}" class="px-2 py-1 bg-gray-200 rounded hover:bg-gray-300">-</button>
        <span class="px-2 py-1 text-sm">${qty}</span>
        <button data-action="plus" data-id="${item.id}" class="px-2 py-1 bg-gray-200 rounded hover:bg-gray-300">+</button>
        <button data-action="remove" data-id="${item.id}" class="px-2 py-1 bg-red-100 text-red-600 rounded hover:bg-red-200"><i class="fas fa-trash"></i></button>
      </div>
    </div>
  `;
    }

    /* -------------------------------
      POSController (updated event handling & robustness)
    ------------------------------- */
    class POSController {
        constructor() {
            this.products = [];
            this.filtered = [];
            this.cart = new Map();

            this.page = 1;
            this.perPage = 10;

            this.bindUI();
            this.loadProducts();
        }

        /* BIND UI */
        bindUI() {
            const search = document.getElementById("search-input");
            if (search) search.addEventListener("input", e => this.search(e.target.value));

            const prev = document.getElementById("prev-page");
            const next = document.getElementById("next-page");
            if (prev) prev.addEventListener("click", () => this.changePage(-1));
            if (next) next.addEventListener("click", () => this.changePage(1));

            // Use event delegation for cart-controls (handles clicks on icons/children)
            const cartContainer = document.getElementById("cart-items");
            if (cartContainer) {
                cartContainer.addEventListener("click", (e) => {
                    const btn = e.target.closest("button[data-action], [data-action]");
                    if (!btn) return;
                    const id = Number(btn.dataset.id);
                    const action = btn.dataset.action;
                    if (!id || !action) return;
                    if (action === "plus") this.increaseQty(id);
                    if (action === "minus") this.decreaseQty(id);
                    if (action === "remove") this.removeItem(id);
                });
            }

            const checkoutBtn = document.getElementById("checkout-btn");
            if (checkoutBtn) checkoutBtn.addEventListener("click", () => this.openCheckout());

            const closeModal = document.getElementById("close-modal");
            if (closeModal) closeModal.addEventListener("click", () => this.closeCheckout());
            const closeModalBtn = document.getElementById("close-modal-btn");
            if (closeModalBtn) closeModalBtn.addEventListener("click", () => this.closeCheckout());

            const confirmCheckout = document.getElementById("confirm-checkout");
            if (confirmCheckout) confirmCheckout.addEventListener("click", () => this.submitSale());

            const cancelBtn = document.getElementById("cancel-btn");
            if (cancelBtn) cancelBtn.addEventListener("click", () => this.cancelCart());

            const holdBtn = document.getElementById("hold-btn");
            if (holdBtn) holdBtn.addEventListener("click", () => this.holdOrder());

            // Payment option toggle (if present)
            document.querySelectorAll('.payment-option').forEach(btn => {
                btn.addEventListener('click', (e) => {
                    document.querySelectorAll('.payment-option').forEach(b => {
                        b.classList.remove('border-2', 'border-green-500');
                        b.classList.add('border', 'border-gray-300');
                    });
                    e.currentTarget.classList.add('border-2', 'border-green-500');
                    e.currentTarget.classList.remove('border', 'border-gray-300');

                    const method = e.currentTarget.textContent.trim().toLowerCase();
                    const input = document.getElementById('payment-method');
                    if (!input) return;
                    if (method.includes('cash')) input.value = 'cash';
                    else if (method.includes('m-pesa') || method.includes('mpesa')) input.value =
                        'mpesa';
                    else if (method.includes('card')) input.value = 'card';
                });
            });
        }

        /* LOAD PRODUCTS (with fallback) */
        async loadProducts() {
            try {
                const res = await fetch("/api/stocks");
                if (!res.ok) throw new Error('Fetch failed');
                this.products = await res.json();
            } catch (err) {
                // Fallback mock data so UI still shows while API is not ready
                console.warn("Failed to fetch /api/stocks — using mock data", err);
                this.products = [{
                        id: 1,
                        name: "Sample Widget",
                        sku: "WGT-01",
                        quantity: 12,
                        price: 3500
                    },
                    {
                        id: 2,
                        name: "Sample Bolt",
                        sku: "BLT-02",
                        quantity: 3,
                        price: 150
                    },
                    {
                        id: 3,
                        name: "Sample Cable",
                        sku: "CBL-03",
                        quantity: 0,
                        price: 1200
                    },
                    // add more if needed
                ];
            }
            this.filtered = [...this.products];
            this.renderProducts();
        }

        /* SEARCH */
        search(term) {
            term = (term ?? "").toString().toLowerCase();
            this.filtered = this.products.filter(p => (safeName(p).toLowerCase().includes(term) || (p.sku ?? "")
                .toLowerCase().includes(term)));
            this.page = 1;
            this.renderProducts();
        }

        /* PAGINATION */
        changePage(step) {
            const max = Math.max(1, Math.ceil(this.filtered.length / this.perPage));
            this.page += step;
            if (this.page < 1) this.page = 1;
            if (this.page > max) this.page = max;
            this.renderProducts();
        }

        /* RENDER PRODUCTS */
        renderProducts() {
            const list = document.getElementById("product-list");
            if (!list) return;
            list.innerHTML = "";

            const start = (this.page - 1) * this.perPage;
            const items = this.filtered.slice(start, start + this.perPage);
            const pageNumber = document.getElementById("page-number");
            if (pageNumber) pageNumber.innerText = `Page ${this.page}`;

            items.forEach(p => {
                const wrap = document.createElement("div");
                wrap.innerHTML = productCard(p);

                // handle clicks on the rendered Add button (safer: use closest)
               wrap.querySelector(".add-btn").onclick = () => this.addToCart(p);

                // append to DOM
                list.appendChild(wrap.firstElementChild);
            });
        }

        /* CART LOGIC */
        addToCart(product) {
            if (this.cart.has(product.id)) {
                this.cart.get(product.id).qty++;
            } else {
                this.cart.set(product.id, {
                    id: product.id,
                    name: product.name,
                    price: product.price,
                    qty: 1
                });
            }
            this.renderCart();
        }
        increaseQty(id) {
            if (!this.cart.has(id)) return;
            this.cart.get(id).qty++;
            this.renderCart();
        }

        decreaseQty(id) {
            if (!this.cart.has(id)) return;
            const it = this.cart.get(id);
            if (it.qty > 1) it.qty--;
            else this.cart.delete(id);
            this.renderCart();
        }

        removeItem(id) {
            this.cart.delete(id);
            this.renderCart();
        }

        /* RENDER CART */
        renderCart() {
            const container = document.getElementById("cart-items");
            const empty = document.getElementById("empty-cart");
            if (!container || !empty) return;

            container.innerHTML = "";

            if (this.cart.size === 0) {
                empty.style.display = "block";
                const totalAmount = document.getElementById("total-amount");
                const cartCount = document.getElementById("cart-count");
                if (totalAmount) totalAmount.innerText = "0 Tsh";
                if (cartCount) cartCount.innerText = "0";
                return;
            }

            empty.style.display = "none";

            let total = 0;
            let itemCount = 0;
            this.cart.forEach(item => {
                total += item.qty * item.price;
                itemCount += item.qty;

                const row = document.createElement("div");
                row.innerHTML = cartItemRow(item);
                container.appendChild(row.firstElementChild);
            });

            const totalAmount = document.getElementById("total-amount");
            const cartCount = document.getElementById("cart-count");
            if (totalAmount) totalAmount.innerText = formatPrice(total) + " Tsh";
            if (cartCount) cartCount.innerText = itemCount;
        }

        cartTotal() {
            let t = 0;
            this.cart.forEach(i => t += i.qty * i.price);
            return t;
        }

        /* CHECKOUT MODAL */
        openCheckout() {
            if (this.cart.size === 0) return alert("Inventory batch is empty!");
            const checkoutTotalEl = document.getElementById("checkout-total");
            if (checkoutTotalEl) checkoutTotalEl.innerText = formatPrice(this.cartTotal()) + " Tsh";
            const modal = document.getElementById("checkout-modal");
            if (modal) modal.classList.remove("hidden");
        }
        closeCheckout() {
            const modal = document.getElementById("checkout-modal");
            if (modal) modal.classList.add("hidden");
        }

        /* SUBMIT INVENTORY */
        async submitSale() {
            const supplierEl = document.getElementById("customer");
            const pmEl = document.getElementById("payment-method");
            const notesEl = document.getElementById("notes");

            const body = {
                supplier: supplierEl ? supplierEl.value : "Supplier",
                grand_total: this.cartTotal(),
                payment_method: pmEl ? pmEl.value : "cash",
                notes: notesEl ? notesEl.value : null,
                items: []
            };

            this.cart.forEach(i => {
                body.items.push({
                    product_id: i.id,
                    quantity: i.qty,
                    unit_amount: i.price,
                    total_amount: i.qty * i.price
                });
            });

            try {
                const res = await fetch("/api/stocking", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify(body)
                });

                if (!res.ok) {
                    const text = await res.text();
                    console.error("Server error:", text);
                    alert("Inventory submission failed — check console.");
                    return;
                }

                const data = await res.json();
                alert("Inventory recorded successfully!");
                this.closeCheckout();
                this.cancelCart();
                // Optionally refresh product list to reflect new stock
                this.loadProducts();
            } catch (err) {
                console.error("Network error:", err);
                alert("Network error while submitting inventory.");
            }
        }

        /* CANCEL & HOLD */
        cancelCart() {
            this.cart.clear();
            this.renderCart();
        }

        async holdOrder() {
            if (this.cart.size === 0) return alert("Cart empty!");
            // Simple hold: POST to /api/pos-orders (as your original logic)
            const body = {
                customer: "Regular",
                grand_total: this.cartTotal(),
                payment_method: "cash",
                items: []
            };
            this.cart.forEach(i => {
                body.items.push({
                    product_id: i.id,
                    quantity: i.qty,
                    unit_amount: i.price,
                    total_amount: i.qty * i.price
                });
            });

            try {
                await fetch("/api/pos-orders", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify(body)
                });
                alert("Order held!");
                this.cancelCart();
            } catch (err) {
                console.error("Hold failed:", err);
                alert("Failed to hold order.");
            }
        }
    }

    /* Initialize controller after page loads */
    window.addEventListener("DOMContentLoaded", () => {
        new POSController();
    });
</script>
