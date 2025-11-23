<script>
    class SalesResource {

        /**
         * Constructor: initializes all properties and loads API data
         */
        constructor() {
            this.apiBase = "/api";
            this.currentView = 'list';
            this.sales = [];
            this.products = [];
            this.currentSaleId = null;

            this.initializeEventListeners();
            this.fetchSales();
            this.fetchProducts();
            this.loadStats();
        }

        /**
         * Price formatter (clean format)
         * Example: 12000 -> 12,000
         */
        formatPrice(value) {
            return Number(value || 0).toLocaleString('en-US', {
                maximumFractionDigits: 0
            });
        }



        async loadStats() {
            try {
                const res = await fetch(`${this.apiBase}/stats/sales`);
                const data = await res.json();

                if (!data.status) {
                    throw new Error("Stats response failed");
                }

                const stats = data.stats;

                document.getElementById("totalSales").textContent =
                    this.formatPrice(stats.total_sales);

                document.getElementById("todaySales").textContent =
                    this.formatPrice(stats.today_sales);

                document.getElementById("todayTransactions").textContent =
                    `${stats.today_transactions} transactions today`;

                document.getElementById("pendingOrders").textContent =
                    this.formatPrice(stats.pending_orders);

                document.getElementById("avgSale").textContent =
                    this.formatPrice(stats.avg_sale);

            } catch (error) {
                console.error("Stats Load Error:", error);
            }
        }



        /**
         * Initialize all event listeners
         */
        initializeEventListeners() {

            // Navigation buttons
            document.getElementById('create-sale-btn')
                .addEventListener('click', () => this.showFormView());

            document.getElementById('back-to-list')
                .addEventListener('click', () => this.showListView());

            document.getElementById('cancel-form')
                .addEventListener('click', () => this.showListView());

            // Form submission
            document.getElementById('sale-form')
                .addEventListener('submit', (e) => this.handleFormSubmit(e));

            // Add sale item button
            document.getElementById('add-item-btn')
                .addEventListener('click', () => this.addSaleItem());

            /**
             * Input changes inside sale items
             * (quantity / price recalculations)
             */
            document.getElementById('sale-items-container').addEventListener('input', () => {
                this.updateTotals();
            });

            /**
             * Product selection event
             * Auto fills unit price when product is selected
             */
            document.getElementById('sale-items-container').addEventListener('change', (e) => {
                if (e.target.classList.contains('product-select')) {

                    const selectedOption = e.target.selectedOptions[0];
                    const price = selectedOption.getAttribute('data-price');

                    const row = e.target.closest('.sale-item');
                    const priceInput = row.querySelector('.price-input');

                    priceInput.value = price ? parseFloat(price) : '';
                    this.updateTotals();
                }
            });

            // Remove item button event
            document.getElementById('sale-items-container').addEventListener('click', (e) => {
                this.handleItemAction(e);
            });

        }

        /**
         * Fetch sales list from API
         */
        async fetchSales() {
            try {
                const res = await fetch(`${this.apiBase}/sales`);
                const data = await res.json();

                if (data.status) {
                    this.sales = data.data;
                    this.renderSalesList();
                }

            } catch (err) {
                console.error("Error fetching sales:", err);
            }
        }

        /**
         * Fetch products from API
         */
        async fetchProducts() {
            try {
                const res = await fetch(`${this.apiBase}/products`);
                const data = await res.json();

                if (data.status) {
                    this.products = data.data;
                }

            } catch (err) {
                console.error("Error fetching products:", err);
            }
        }

        /**
         * Switch to sales list view
         */
        showListView() {
            this.currentView = 'list';

            document.getElementById('list-view').classList.remove('hidden');
            document.getElementById('form-view').classList.add('hidden');

            document.getElementById('page-title').textContent = 'Sales';
            document.getElementById('page-description').textContent = 'Manage your sales transactions';
        }

        /**
         * Switch to sale form view
         */
        showFormView(saleId = null) {
            this.currentView = 'form';
            this.currentSaleId = saleId;

            document.getElementById('list-view').classList.add('hidden');
            document.getElementById('form-view').classList.remove('hidden');

            if (saleId) {
                document.getElementById('form-title').textContent = 'Edit Sale';
                this.loadSaleForEdit(saleId);
            } else {
                document.getElementById('form-title').textContent = 'Create New Sale';
                this.resetForm();
            }
        }

        /**
         * Reset sale form completely
         */
        resetForm() {
            document.getElementById('sale-form').reset();
            document.getElementById('sale-items-container').innerHTML = "";
            this.addSaleItem();
            this.updateTotals();
        }

        /**
         * Add a new sale item row
         */
        addSaleItem(product = null) {

            const container = document.getElementById('sale-items-container');
            const itemId = Date.now();

            const itemHtml = `
        <tr class="sale-item" data-item-id="${itemId}">
            <td class="px-4 py-3">
                <select name="items[${itemId}][product_id]"
                        class="product-select w-full px-2 py-1 border border-gray-300 rounded text-sm focus:outline-none focus:ring-1 focus:ring-green-500">

                    <option value="">Select Product</option>

                    ${this.products.map(p => `
                        <option value="${p.id}"
                                data-price="${p.price}"
                                ${product && product.product_id === p.id ? 'selected' : ''}>
                            ${p.name} - ${this.formatPrice(p.price)}
                        </option>
                    `).join('')}
                </select>
            </td>


            <td>
                <input type="number"  min="1"
                       name="items[${itemId}][quantity]"
                       value="${product ? product.quantity : 1}"
                      class="quantity-input w-20 px-2 py-1 border border-gray-300 rounded text-sm focus:outline-none focus:ring-1 focus:ring-green-500">
            </td>

            <td>
                <input type="number"

                       name="items[${itemId}][unit_amount]"
                       value="${product ? product.unit_amount : ''}"
                      class="price-input w-24 px-2 py-1 border border-gray-300 rounded text-sm focus:outline-none focus:ring-1 focus:ring-green-500" placeholder="0">
            </td>

            <td>
                <span class="item-total text-sm font-medium">0</span>
            </td>

         <td class="px-4 py-3">
                            <button type="button" class="remove-item text-red-600 hover:text-red-800">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
        </tr>
        `;

            container.insertAdjacentHTML('beforeend', itemHtml);
            this.updateTotals();
        }

        /**
         * Remove sale item row
         */
        handleItemAction(e) {
            if (e.target.closest('.remove-item')) {

                const itemRow = e.target.closest('.sale-item');

                if (document.querySelectorAll('.sale-item').length > 1) {
                    itemRow.remove();
                    this.updateTotals();
                } else {
                    alert("At least one product is required.");
                }
            }
        }

        /**
         * Recalculate totals (subtotal, tax, grand total)
         */
        updateTotals() {

            let subtotal = 0;

            document.querySelectorAll('.sale-item').forEach(row => {

                const quantity = parseFloat(row.querySelector('.quantity-input').value) || 0;
                const price = parseFloat(row.querySelector('.price-input').value) || 0;

                const total = quantity * price;
                subtotal += total;

                row.querySelector('.item-total').textContent = this.formatPrice(total);
            });

            const tax = subtotal * 0;
            const grandTotal = subtotal + tax;

            document.getElementById('subtotal-display').textContent = this.formatPrice(subtotal);
            document.getElementById('tax-display').textContent = this.formatPrice(tax);
            document.getElementById('grand-total-display').textContent = this.formatPrice(grandTotal);
        }

        /**
         * Render sales list table
         */
        renderSalesList() {
            const tbody = document.getElementById('sales-table-body');
            tbody.innerHTML = "";

            this.sales.forEach(sale => {
                const row = this.createSaleRow(sale);
                tbody.appendChild(row);
            });
        }

        truncate(text, max = 30) {
            if (!text) return "No notes";
            return text.length > max ? text.substring(0, max) + "..." : text;
        }


        /**
         * Create single sale table row
         */
        createSaleRow(sale) {

            const row = document.createElement('tr');
            row.className = 'table-row';


            const statusBadge = sale.status === 'paid' ?
                '<span class="status-badge bg-green-100 text-green-800">Paid</span>' :
                '<span class="status-badge bg-yellow-100 text-yellow-800">Pending</span>';

            const paymentBadge = this.getPaymentBadge(sale.payment_method);

            row.innerHTML = `

            <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="h-10 w-10 bg-green-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-shopping-cart text-green-600"></i>
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-medium text-gray-900">${sale.customer}</div>
                               <div class="text-sm text-gray-500 max-w-[160px] truncate" title="${sale.notes}">
                                   ${this.truncate(sale.notes, 40)}
                          </div>
                            </div>
                        </div>
                    </td>

          <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${sale.customer}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">${this.formatPrice(sale.grand_total)}</td>

              <td class="px-6 py-4 whitespace-nowrap">${paymentBadge}</td>
                    <td class="px-6 py-4 whitespace-nowrap">${statusBadge}</td>
                   <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${new Date(sale.created_at).toLocaleDateString()}</td>

            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <button class="text-green-600 hover:text-green-900 mr-3 edit-sale" data-id="${sale.id}">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="text-red-600 hover:text-red-900 delete-sale" data-id="${sale.id}">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
        `;

            row.querySelector('.edit-sale').addEventListener('click', () => this.showFormView(sale.id));
            row.querySelector('.delete-sale').addEventListener('click', () => this.deleteSale(sale.id));

            return row;
        }

        //
        getPaymentBadge(method) {
            const badges = {
                cash: 'bg-green-100 text-green-800',
                card: 'bg-blue-100 text-blue-800',
                mobile: 'bg-purple-100 text-purple-800',
                credit: 'bg-yellow-100 text-yellow-800'
                // mpesa: 'bg-red-100 text-red-800'
            };

            const methodText = {
                cash: 'Cash',
                card: 'Card',
                mobile: 'Mobile',
                mpesa: 'M-pesa',
                credit: 'Credit'
            };

            return `<span class="payment-badge ${badges[method]}">${methodText[method]}</span>`;
        }

        /**
         * Load a sale into edit form
         */
        async loadSaleForEdit(saleId) {
            try {
                const res = await fetch(`${this.apiBase}/sales/${saleId}`);
                const data = await res.json();

                if (data.status) {
                    const sale = data.data;

                    document.getElementById('customer').value = sale.customer;
                    document.getElementById('payment_method').value = sale.payment_method;
                    document.getElementById('notes').value = sale.notes;

                    document.getElementById('sale-items-container').innerHTML = "";

                    sale.items.forEach(item => {
                        this.addSaleItem(item);
                    });

                    this.updateTotals();
                }
            } catch (err) {
                console.error(err);
            }
        }

        /**
         * Handle form submit (create/update)
         */
        /**
         * Handle Sale Form Submit (Create & Update)
         */
        async handleFormSubmit(e) {
            e.preventDefault();

            const items = [];

            /**
             * Collect sale items
             */
            document.querySelectorAll('.sale-item').forEach(row => {

                const productId = row.querySelector('.product-select').value;
                const quantity = parseFloat(row.querySelector('.quantity-input').value);
                const unitAmount = parseFloat(row.querySelector('.price-input').value);

                if (productId && quantity > 0 && unitAmount > 0) {
                    const total = quantity * unitAmount;

                    items.push({
                        product_id: productId,
                        quantity: quantity,
                        unit_amount: unitAmount,
                        total_amount: total
                    });
                }
            });

            /**
             * If no products selected
             */
            if (items.length === 0) {
                alert("Please add at least one product.");
                return;
            }

            /**
             * Calculate totals
             */
            const subTotal = items.reduce((sum, item) => sum + item.total_amount, 0);

            const taxRate = 0; // 8% VAT
            const tax = subTotal * taxRate;
            const grandTotal = subTotal + tax;

            /**
             * Final sale payload
             */
            const payload = {
                customer: document.getElementById("customer").value,
                payment_method: document.getElementById("payment_method").value,
                notes: document.getElementById("notes").value,
                sub_total: parseFloat(subTotal.toFixed(0)),
                // tax: parseFloat(tax.toFixed(0)),
                grand_total: parseFloat(grandTotal.toFixed(0)),
                items: items
            };

            /**
             * Detect create or update
             */
            let url = "/api/sales";
            let method = "POST";

            if (this.currentSaleId) {
                url = `/api/sales/${this.currentSaleId}`;
                method = "PUT";
            }

            /**
             * Send to API
             */
            try {
                const response = await fetch(url, {
                    method: method,
                    headers: {
                        "Content-Type": "application/json",
                        "Accept": "application/json"
                    },
                    body: JSON.stringify(payload)
                });

                const result = await response.json();

                if (!response.ok) {
                    throw new Error(result.message || "Something went wrong");
                }

                alert(`Sale ${this.currentSaleId ? "updated" : "created"} successfully!`);

                this.showListView();
                this.fetchSales(); // Correct
                this.resetForm();
                // this.loadSales();
                // this.loadStats();

            } catch (error) {
                console.error("Sale Error:", error);
                alert("Failed to process sale. Try again.");
            }
        }





        /**
         * Create new sale
         */
        async createSale(saleData) {

            let url = "/api/sales";

            try {
                const response = await fetch(url, {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "Accept": "application/json"
                    },
                    body: JSON.stringify(saleData)
                });

                const result = await response.json();

                if (!response.ok) {
                    throw new Error(result.message || "Failed to create sale");
                }

                alert("Sale created successfully!");

                this.showListView();
                this.loadSales();
                this.loadStats();

            } catch (error) {
                console.error("Create Sale Error:", error);
                alert("Unable to create sale.");
            }
        }


        /**
         * Update existing sale
         */
        // async updateSale(saleId, saleData) {

        //     const res = await fetch(`${this.apiBase}/sales/${saleId}`, {
        //         method: "PUT",
        //         headers: {
        //             "Content-Type": "application/json"
        //         },
        //         body: JSON.stringify(saleData)
        //     });

        //     const data = await res.json();

        //     if (data.status) {
        //         alert("Sale updated!");
        //         this.fetchSales();
        //         this.showListView();
        //     } else {
        //         alert(data.error);
        //     }
        // }
        async updateSale(saleId, saleData) {

            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            const res = await fetch(`${this.apiBase}/sales/${saleId}`, {
                method: "PUT",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": token
                },
                body: JSON.stringify(saleData)
            });

            const data = await res.json();

            if (data.status) {
                alert("Sale updated!");
                this.fetchSales();
                this.showListView();
            } else {
                console.error(data);
                alert(data.message || data.error);
            }
        }


        /**
         * Delete sale
         */
        async deleteSale(saleId) {

            if (!confirm("Delete this sale?")) return;

            const res = await fetch(`${this.apiBase}/sales/${saleId}`, {
                method: "DELETE"
            });

            const data = await res.json();

            if (data.status) {
                alert("Sale deleted!");
                this.fetchSales();
            } else {
                alert(data.error);
            }
        }
    }

    /**
     * Initialize system on page load
     */
    document.addEventListener('DOMContentLoaded', () => {
        window.salesResource = new SalesResource();
        salesResource.loadStats();

    });
</script>
