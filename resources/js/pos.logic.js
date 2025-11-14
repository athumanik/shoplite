// pos.logic.js
export default class POSLogic {
  constructor({ apiBase = '/api' } = {}) {
    this.apiBase = apiBase;
    this.products = [];
    this.cart = new Map(); // key: productId -> { product, quantity, unitAmount, totalAmount }
    this.taxRate = 0.08;
    this.paymentMethod = 'cash';
    this.customer = 'Regular';
  }

  /* ---------- Products API ---------- */
  async loadProducts() {
    const res = await fetch(`${this.apiBase}/products`);
    if (!res.ok) throw new Error('Failed to load products');
    this.products = await res.json();
    return this.products;
  }

  getProductById(id) {
    return this.products.find(p => Number(p.id) === Number(id));
  }

  /* ---------- Cart operations (logic only) ---------- */
  addToCart(product, qty = 1) {
    const id = Number(product.id);
    const unitAmount = Number(product.price) || 0;
    if (this.cart.has(id)) {
      const item = this.cart.get(id);
      item.quantity += qty;
      item.totalAmount = item.quantity * item.unitAmount;
    } else {
      this.cart.set(id, {
        product,
        quantity: qty,
        unitAmount,
        totalAmount: qty * unitAmount
      });
    }
    return this.getCartSummary();
  }

  increaseQty(productId) {
    const id = Number(productId);
    if (!this.cart.has(id)) return;
    const item = this.cart.get(id);
    item.quantity += 1;
    item.totalAmount = item.quantity * item.unitAmount;
    return this.getCartSummary();
  }

  decreaseQty(productId) {
    const id = Number(productId);
    if (!this.cart.has(id)) return;
    const item = this.cart.get(id);
    if (item.quantity > 1) {
      item.quantity -= 1;
      item.totalAmount = item.quantity * item.unitAmount;
    } else {
      this.cart.delete(id);
    }
    return this.getCartSummary();
  }

  removeFromCart(productId) {
    this.cart.delete(Number(productId));
    return this.getCartSummary();
  }

  clearCart() {
    this.cart.clear();
    this.paymentMethod = 'cash';
    this.customer = 'Regular';
    return this.getCartSummary();
  }

  calculateSubtotal() {
    let subtotal = 0;
    for (const item of this.cart.values()) subtotal += Number(item.totalAmount);
    return subtotal;
  }

  calculateTax() {
    return this.calculateSubtotal() * this.taxRate;
  }

  calculateTotal() {
    return this.calculateSubtotal() + this.calculateTax();
  }

  getCartSummary() {
    return {
      items: Array.from(this.cart.values()).map(i => ({
        product_id: Number(i.product.id),
        name: i.product.name,
        quantity: i.quantity,
        unit_amount: Number(i.unitAmount),
        total_amount: Number(i.totalAmount)
      })),
      subtotal: this.calculateSubtotal(),
      tax: this.calculateTax(),
      total: this.calculateTotal()
    };
  }

  /* ---------- Backend actions ---------- */
  async holdSale({ customer = null, payment_method = null, notes = null } = {}) {
    if (this.cart.size === 0) throw new Error('Cart empty');

    const payload = {
      customer: customer ?? this.customer,
      payment_method: payment_method ?? this.paymentMethod,
      grand_total: this.calculateTotal(),
      status: 'pending',
      notes: notes ?? null,
      items: Array.from(this.cart.values()).map(i => ({
        product_id: Number(i.product.id),
        quantity: i.quantity,
        unit_amount: Number(i.unitAmount),
        total_amount: Number(i.totalAmount)
      }))
    };

    const res = await fetch(`${this.apiBase}/orders`, {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify(payload)
    });

    const json = await res.json();
    if (!res.ok) throw new Error(json?.message || 'Failed to hold sale');
    // Optionally clear cart after hold:
    this.clearCart();
    return json;
  }

  async completeSale({ customer = null, payment_method = null, notes = null } = {}) {
    if (this.cart.size === 0) throw new Error('Cart empty');

    const payload = {
      customer: customer ?? this.customer,
      payment_method: payment_method ?? this.paymentMethod,
      grand_total: this.calculateTotal(),
      items: Array.from(this.cart.values()).map(i => ({
        product_id: Number(i.product.id),
        quantity: i.quantity,
        unit_amount: Number(i.unitAmount),
        total_amount: Number(i.totalAmount)
      })),
      notes: notes ?? null
    };

    const res = await fetch(`${this.apiBase}/sales`, {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify(payload)
    });
    const json = await res.json();
    if (!res.ok) throw new Error(json?.message || 'Failed to complete sale');

    this.clearCart();
    return json;
  }
}
