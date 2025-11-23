  {{-- POS LOGIC (Pagination, Cart, Checkout, API) --}}
  <script>
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

          /* -------------------------------
              BIND UI
          ------------------------------- */
          bindUI() {
              document.getElementById("search-input")
                  .addEventListener("input", e => this.search(e.target.value));

              document.getElementById("prev-page").onclick = () => this.changePage(-1);
              document.getElementById("next-page").onclick = () => this.changePage(1);

              document.getElementById("cart-items")
                  .addEventListener("click", e => {
                      let id = e.target.dataset.id;
                      let action = e.target.dataset.action;
                      if (!id || !action) return;

                      id = Number(id);
                      if (action === "plus") this.increaseQty(id);
                      if (action === "minus") this.decreaseQty(id);
                      if (action === "remove") this.removeItem(id);
                  });

              document.getElementById("checkout-btn").onclick = () => this.openCheckout();
              document.getElementById("close-modal").onclick = () => this.closeCheckout();
              document.getElementById("close-modal-btn").onclick = () => this.closeCheckout();
              document.getElementById("confirm-checkout").onclick = () => this.submitSale();

              document.getElementById("cancel-btn").onclick = () => this.cancelCart();
              document.getElementById("hold-btn").onclick = () => this.holdOrder();

              // Payment option buttons
              document.querySelectorAll('.payment-option').forEach(btn => {
                  btn.addEventListener('click', (e) => {
                      // Remove active class from all buttons
                      document.querySelectorAll('.payment-option').forEach(b => {
                          b.classList.remove('border-2', 'border-green-500');
                          b.classList.add('border', 'border-gray-300');
                      });

                      // Add active class to clicked button
                      e.target.classList.add('border-2', 'border-green-500');
                      e.target.classList.remove('border', 'border-gray-300');

                      // Set payment method
                      const method = e.target.textContent.trim().toLowerCase();
                      if (method.includes('cash')) {
                          document.getElementById('payment-method').value = 'cash';
                      } else if (method.includes('m-pesa')) {
                          document.getElementById('payment-method').value = 'mpesa';
                      } else if (method.includes('card')) {
                          document.getElementById('payment-method').value = 'card';
                      }
                  });
              });
          }

          /* -------------------------------
              LOAD PRODUCTS
          ------------------------------- */
          async loadProducts() {
              // Simulate API call with mock data
              let res = await fetch("/api/pos");
              this.products = await res.json();
              this.filtered = [...this.products];
              this.renderProducts();
          }

          /* -------------------------------
              SEARCH
          ------------------------------- */
          search(term) {
              term = term.toLowerCase();
              this.filtered = this.products.filter(p =>
                  p.name.toLowerCase().includes(term)
              );

              this.page = 1;
              this.renderProducts();
          }

          /* -------------------------------
              PAGINATION
          ------------------------------- */
          changePage(step) {
              let max = Math.ceil(this.filtered.length / this.perPage);
              this.page += step;

              if (this.page < 1) this.page = 1;
              if (this.page > max) this.page = max;

              this.renderProducts();
          }

          /* -------------------------------
              RENDER PRODUCTS
          ------------------------------- */
          renderProducts() {
              let list = document.getElementById("product-list");
              list.innerHTML = "";

              let start = (this.page - 1) * this.perPage;
              let items = this.filtered.slice(start, start + this.perPage);

              document.getElementById("page-number").innerText = `Page ${this.page}`;

              items.forEach(p => {
                  let wrap = document.createElement("div");
                  wrap.innerHTML = productCard(p);

                  wrap.querySelector(".add-btn").onclick = () => this.addToCart(p);

                  list.appendChild(wrap.firstElementChild);
              });
          }

          /* -------------------------------
              CART LOGIC
          ------------------------------- */
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

          /* -------------------------------
              RENDER CART
          ------------------------------- */
          renderCart() {
              let container = document.getElementById("cart-items");
              let empty = document.getElementById("empty-cart");

              container.innerHTML = "";

              if (this.cart.size === 0) {
                  empty.style.display = "block";
                  document.getElementById("total-amount").innerText = "0";
                  document.getElementById("cart-count").innerText = "0";
                  return;
              }

              empty.style.display = "none";

              let total = 0;
              let itemCount = 0;

              this.cart.forEach(item => {
                  total += item.qty * item.price;
                  itemCount += item.qty;

                  let row = document.createElement("div");
                  row.innerHTML = cartItemRow(item);
                  container.appendChild(row.firstElementChild);
              });

              document.getElementById("total-amount").innerText =
                  total.toLocaleString();
              document.getElementById("cart-count").innerText = itemCount;
          }

          cartTotal() {
              let t = 0;
              this.cart.forEach(i => t += i.qty * i.price);
              return t;
          }

          /* -------------------------------
              CHECKOUT MODAL
          ------------------------------- */
          openCheckout() {
              if (this.cart.size === 0) return alert("Cart empty!");
              document.getElementById("checkout-total").innerText =
                  this.cartTotal().toLocaleString() + " Tsh";
              document.getElementById("checkout-modal").classList.remove("hidden");
          }

          closeCheckout() {
              document.getElementById("checkout-modal").classList.add("hidden");
          }

          /* -------------------------------
              SUBMIT CHECKOUT TO API
          ------------------------------- */
          async submitSale() {
              let body = {
                  customer: document.getElementById("customer").value,
                  // customer_type: "regular",
                  grand_total: this.cartTotal(),
                  payment_method: document.getElementById("payment-method").value,
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

              // Simulate API call
              // console.log("Submitting sale:", body);

              // In a real implementation, you would use:

              let res = await fetch("/api/sales", {
                  // let res = await fetch("/api/pos-sales", {
                  method: "POST",
                  headers: {
                      "Content-Type": "application/json"
                  },
                  body: JSON.stringify(body)
              });

              let data = await res.json();



              this.closeCheckout();

              this.cancelCart();
              Swal.fire({
                  icon: 'success',
                  title: 'Sale Completed!',
                  text: 'Your sale has been saved successfully.',
                  confirmButtonText: 'OK'
              });

              this.loadProducts();
          }

          /* -------------------------------
              CANCEL & HOLD
          ------------------------------- */
          cancelCart() {
              this.cart.clear();
              this.renderCart();
          }

          async holdOrder() {
              if (this.cart.size === 0) return alert("Cart empty!");

              let body = {
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

              // Simulate API call
              // console.log("Holding order:", body);

              // In a real implementation, you would use:

              await fetch("/api/pos-orders", {
                  method: "POST",
                  headers: {
                      "Content-Type": "application/json"
                  },
                  body: JSON.stringify(body)
              });


              alert("Order held!");
              this.cancelCart();
          }
      }

      new POSController();
  </script>
