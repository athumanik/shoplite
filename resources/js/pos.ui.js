// pos.ui.js
import POSLogic from './pos.logic.js';

export default class POSUI {
  constructor({ logic, selectors } = {}) {
    this.logic = logic || new POSLogic();
    // selectors - DOM hooks used in your HTML
    this.selectors = Object.assign({
      productsGrid: '#products-grid',
      cartItems: '#cart-items',
      emptyCartMessage: '#empty-cart-message',
      subtotal: '#subtotal',
      tax: '#tax',
      total: '#total',
      searchInput: '#search-input',
      categoryBtns: '.category-btn',
      checkoutBtn: '#checkout-btn',
      holdSaleBtn: '#hold-sale-btn',
      cancelSaleBtn: '#cancel-sale-btn',
      newSaleBtn: '#new-sale-btn',
      paymentChips: '.payment-chip',
      checkoutModal: '#checkout-modal',
      modalCustomerName: '#customer-name',
      modalCartItems: '#modal-cart-items',
      modalSubtotal: '#modal-subtotal',
      modalTax: '#modal-tax',
      modalTotal: '#modal-total',
      closeModalBtn: '#close-modal',
      completeSaleModalBtn: '#complete-sale-modal-btn',
      holdSaleModalBtn: '#hold-sale-modal-btn'
    }, selectors || {});

    this.bindDom();
  }

  async init() {
    await this.loadAndRenderProducts();
    this.renderCart();
  }

  bindDom() {
    // event delegation for cart item actions
    document.querySelector(this.selectors.cartItems).addEventListener('click', (e) => {
      const btn = e.target.closest('button');
      if (!btn) return;
      const action = btn.dataset.action;
      const id = Number(btn.dataset.id);
      if (action === 'plus') { this.logic.increaseQty(id); this.renderCart(); }
      if (action === 'minus') { this.logic.decreaseQty(id); this.renderCart(); }
      if (action === 'remove') { this.logic.removeFromCart(id); this.renderCart(); }
    });

    // search
    const search = document.querySelector(this.selectors.searchInput);
    if (search) {
      search.addEventListener('input', (e) => {
        const q = e.target.value.trim().toLowerCase();
        if (!q) return this.renderProducts(this.logic.products);
        const filtered = this.logic.products.filter(p =>
          String(p.name).toLowerCase().includes(q) ||
          String(p.slug || '').toLowerCase().includes(q)
        );
        this.renderProducts(filtered);
      });
    }

    // categories (simple client-side filter)
    document.querySelectorAll(this.selectors.categoryBtns).forEach(btn => {
      btn.addEventListener('click', (e) => {
        document.querySelectorAll(this.selectors.categoryBtns).forEach(b => b.classList.remove('active','bg-green-600','text-white'));
        e.currentTarget.classList.add('active','bg-green-600','text-white');
        const category = e.currentTarget.textContent.trim();
        if (category === 'All Products') return this.renderProducts(this.logic.products);
        const filtered = this.logic.products.filter(p => (p.category || '').trim() === category);
        this.renderProducts(filtered);
      });
    });

    // payment chips
    document.querySelectorAll(this.selectors.paymentChips).forEach(chip => {
      chip.addEventListener('click', (e) => {
        const method = e.currentTarget.dataset.method;
        this.logic.paymentMethod = method;
        document.querySelectorAll(this.selectors.paymentChips).forEach(c => c.classList.remove('active','bg-green-600','text-white'));
        e.currentTarget.classList.add('active','bg-green-600','text-white');
      });
    });

    // action buttons
    document.querySelector(this.selectors.newSaleBtn).addEventListener('click', () => {
      if (this.logic.cart.size && !confirm('Start a new sale? Current cart will be cleared.')) return;
      this.logic.clearCart();
      this.renderCart();
    });

    document.querySelector(this.selectors.cancelSaleBtn).addEventListener('click', () => {
      if (this.logic.cart.size && confirm('Cancel sale?')) {
        this.logic.clearCart();
        this.renderCart();
      }
    });

    document.querySelector(this.selectors.holdSaleBtn).addEventListener('click', async () => {
      try {
        await this.openHoldModalAndHold(); // separate for clarity
      } catch (err) { alert(err.message || err); }
    });

    document.querySelector(this.selectors.checkoutBtn).addEventListener('click', async () => {
      if (this.logic.cart.size === 0) return alert('Add items first');
      // open modal (reuse your existing modal)
      this.updateModal();
      document.querySelector(this.selectors.checkoutModal).style.display = 'block';
    });

    // modal actions
    document.querySelector(this.selectors.closeModalBtn).addEventListener('click', () => {
      document.querySelector(this.selectors.checkoutModal).style.display = 'none';
    });

    document.querySelector(this.selectors.completeSaleModalBtn).addEventListener('click', async () => {
      try {
        const customer = document.querySelector(this.selectors.modalCustomerName).value || 'Regular';
        await this.logic.completeSale({ customer, payment_method: this.logic.paymentMethod });
        alert('Sale completed');
        document.querySelector(this.selectors.checkoutModal).style.display = 'none';
        this.renderCart();
      } catch (err) {
        alert(err.message || 'Could not complete sale');
      }
    });

    document.querySelector(this.selectors.holdSaleModalBtn).addEventListener('click', async () => {
      try {
        const customer = document.querySelector(this.selectors.modalCustomerName).value || 'Regular';
        await this.logic.holdSale({ customer, payment_method: this.logic.paymentMethod });
        alert('Sale held');
        document.querySelector(this.selectors.checkoutModal).style.display = 'none';
        this.renderCart();
      } catch (err) {
        alert(err.message || 'Could not hold sale');
      }
    });
  }

  async loadAndRenderProducts() {
    try {
      await this.logic.loadProducts();
      this.renderProducts(this.logic.products);
    } catch (err) {
      console.error('Products load error', err);
      document.querySelector(this.selectors.productsGrid).innerHTML = '<div class="text-red-500 p-4">Failed to load products</div>';
    }
  }

  renderProducts(products) {
    const grid = document.querySelector(this.selectors.productsGrid);
    grid.innerHTML = '';
    if (!products || products.length === 0) {
      grid.innerHTML = '<div class="text-gray-500 p-4">No products</div>';
      return;
    }
    products.forEach(p => {
      const card = document.createElement('div');
      card.className = 'product-card bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden cursor-pointer';
      // minimal card, avoid Tailwind dynamic class issues
      card.innerHTML = `
        <div class="p-3">
          <h3 class="font-medium text-gray-900 text-sm">${p.name}</h3>
          <p class="text-xs text-gray-500 mt-1">${p.category || ''}</p>
          <div class="flex items-center justify-between mt-2">
            <span class="text-sm font-bold text-green-600">$${Number(p.price).toFixed(2)}</span>
          </div>
          <button class="w-full mt-2 bg-green-600 text-white py-1 rounded text-xs hover:bg-green-700 add-to-cart" data-id="${p.id}">
            Add to Cart
          </button>
        </div>
      `;
      // add-to-cart click
      card.querySelector('.add-to-cart').addEventListener('click', (ev) => {
        ev.stopPropagation();
        this.logic.addToCart(p, 1);
        this.renderCart();
      });
      grid.appendChild(card);
    });
  }

  renderCart() {
    const container = document.querySelector(this.selectors.cartItems);
    const empty = document.querySelector(this.selectors.emptyCartMessage);
    container.innerHTML = '';
    if (this.logic.cart.size === 0) {
      if (empty) empty.style.display = 'block';
      return;
    } else {
      if (empty) empty.style.display = 'none';
    }

    this.logic.cart.forEach((item) => {
      const id = Number(item.product.id);
      const div = document.createElement('div');
      div.className = 'cart-item p-3 bg-gray-50 rounded-lg';
      div.innerHTML = `
        <div class="flex justify-between items-start">
          <div class="flex-1">
            <h4 class="font-medium text-gray-900 text-sm">${item.product.name}</h4>
            <p class="text-xs text-gray-500">$${Number(item.unitAmount).toFixed(2)} × ${item.quantity}</p>
          </div>
          <div class="text-right">
            <div class="font-bold text-gray-900 text-sm">$${Number(item.totalAmount).toFixed(2)}</div>
            <div class="flex items-center space-x-2 mt-1">
              <button data-action="minus" data-id="${id}" class="w-6 h-6 rounded-full bg-gray-200 flex items-center justify-center decrease-qty">-</button>
              <span class="text-xs">${item.quantity}</span>
              <button data-action="plus" data-id="${id}" class="w-6 h-6 rounded-full bg-gray-200 flex items-center justify-center increase-qty">+</button>
              <button data-action="remove" data-id="${id}" class="text-red-500 ml-1 remove-item"><i class="fas fa-trash text-xs"></i></button>
            </div>
          </div>
        </div>
      `;
      container.appendChild(div);
    });

    // update summary
    const summary = this.logic.getCartSummary();
    document.querySelector(this.selectors.subtotal).textContent = `$${summary.subtotal.toFixed(2)}`;
    document.querySelector(this.selectors.tax).textContent = `$${summary.tax.toFixed(2)}`;
    document.querySelector(this.selectors.total).textContent = `$${summary.total.toFixed(2)}`;
  }

  updateModal() {
    const summary = this.logic.getCartSummary();
    const modalList = document.querySelector(this.selectors.modalCartItems);
    modalList.innerHTML = '';
    summary.items.forEach(i => {
      const div = document.createElement('div');
      div.className = 'flex justify-between text-sm';
      div.innerHTML = `<span>${i.name} × ${i.quantity}</span><span>$${i.total_amount.toFixed(2)}</span>`;
      modalList.appendChild(div);
    });
    document.querySelector(this.selectors.modalSubtotal).textContent = `$${summary.subtotal.toFixed(2)}`;
    document.querySelector(this.selectors.modalTax).textContent = `$${summary.tax.toFixed(2)}`;
    document.querySelector(this.selectors.modalTotal).textContent = `$${summary.total.toFixed(2)}`;
    document.querySelector(this.selectors.modalCustomerName).value = this.logic.customer || 'Regular';
  }

  async openHoldModalAndHold() {
    // show modal first
    this.updateModal();
    document.querySelector(this.selectors.checkoutModal).style.display = 'block';
    // you'll then click "Hold Sale" inside modal (bound in bindDom)
  }
}
