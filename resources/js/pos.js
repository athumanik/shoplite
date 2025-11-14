class PosController {
    constructor() {
        this.products = [];
        this.filtered = [];
        this.cart = new Map();

        this.page = 1;
        this.perPage = 20;

        this.bindUI();
        this.loadProducts();
    }

    bindUI() {
        document.getElementById("search-input").addEventListener("input", (e) => {
            this.search(e.target.value);
        });

        document.getElementById("prev-page").addEventListener("click", () => {
            if (this.page > 1) {
                this.page--;
                this.renderProducts();
            }
        });

        document.getElementById("next-page").addEventListener("click", () => {
            let maxPage = Math.ceil(this.filtered.length / this.perPage);
            if (this.page < maxPage) {
                this.page++;
                this.renderProducts();
            }
        });

        document.getElementById("cart-items").addEventListener("click", (e) => {
            let id = e.target.dataset.id;
            let action = e.target.dataset.action;
            if (!id || !action) return;
            id = parseInt(id);

            if (action === "plus") this.increaseQty(id);
            if (action === "minus") this.decreaseQty(id);
            if (action === "remove") this.removeItem(id);
        });

        document.getElementById("cancel-btn").onclick = () => this.cancelCart();
        document.getElementById("hold-btn").onclick = () => this.holdOrder();
        document.getElementById("checkout-btn").onclick = () => this.checkoutSale();
    }

    async loadProducts() {
        let res = await fetch("/api/products");
        this.products = await res.json();
        this.filtered = [...this.products];
        this.renderProducts();
    }

    search(term) {
        term = term.toLowerCase();
        this.filtered = this.products.filter(p => p.name.toLowerCase().includes(term));
        this.page = 1;
        this.renderProducts();
    }

    renderProducts() {
        let list = document.getElementById("product-list");
        list.innerHTML = "";

        let start = (this.page - 1) * this.perPage;
        let end = start + this.perPage;
        let items = this.filtered.slice(start, end);

        items.forEach(product => {
            let div = document.createElement("div");
            div.innerHTML = productCard(product);
            div.onclick = () => this.addToCart(product);
            list.appendChild(div.firstElementChild);
        });

        document.getElementById("page-info").innerText =
            `Page ${this.page} of ${Math.ceil(this.filtered.length / this.perPage)}`;
    }

    addToCart(product) {
        if (this.cart.has(product.id)) {
            this.cart.get(product.id).qty++;
        } else {
            this.cart.set(product.id, { ...product, qty: 1 });
        }
        this.renderCart();
    }

    increaseQty(id) {
        this.cart.get(id).qty++;
        this.renderCart();
    }

    decreaseQty(id) {
        let item = this.cart.get(id);
        if (item.qty > 1) item.qty--;
        else this.cart.delete(id);
        this.renderCart();
    }

    removeItem(id) {
        this.cart.delete(id);
        this.renderCart();
    }

    renderCart() {
        let container = document.getElementById("cart-items");
        let empty = document.getElementById("empty-cart");

        container.innerHTML = "";

        if (this.cart.size === 0) {
            empty.classList.remove("hidden");
            document.getElementById("total-amount").innerText = "0";
            return;
        }

        empty.classList.add("hidden");

        let total = 0;

        this.cart.forEach(item => {
            total += item.qty * item.price;
            let div = document.createElement("div");
            div.innerHTML = cartItemRow(item);
            container.appendChild(div.firstElementChild);
        });

        document.getElementById("total-amount").innerText =
            total.toLocaleString() + " Tsh";
    }

    cancelCart() {
        this.cart.clear();
        this.renderCart();
    }

    async holdOrder() {
        if (this.cart.size === 0) return alert("Cart is empty!");

        let payload = {
            customer: "Regular",
            grand_total: this.cartTotal(),
            items: [...this.cart.values()]
        };

        let res = await fetch("/api/orders/hold", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify(payload)
        });

        let data = await res.json();
        alert("Order held successfully!");
        this.cancelCart();
    }

    async checkoutSale() {
        if (this.cart.size === 0) return alert("Cart is empty!");

        let payload = {
            customer: "Regular",
            grand_total: this.cartTotal(),
            items: [...this.cart.values()]
        };

        let res = await fetch("/api/sales/pay", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify(payload)
        });

        let data = await res.json();
        alert("Sale completed!");
        this.cancelCart();
    }

    cartTotal() {
        let total = 0;
        this.cart.forEach(i => total += i.qty * i.price);
        return total;
    }
}

new PosController();
