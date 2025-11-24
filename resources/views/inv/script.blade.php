<script>
    class InventoryResource {
        constructor() {
            this.apiBase = "/api";
            this.currentView = 'list';
            this.inventories = [];
            this.products = [];

            this.currentPage = 1;
            this.totalPages = 1;
            this.searchTerm = '';
            this.isLoading = false;
            this.currentInventoryId = null;

            this.initializeEventListeners();
            this.loadInventories();
            this.loadProducts();
        }


        initializeEventListeners() {
            // Navigation
            document.getElementById('create-inventory-btn').addEventListener('click', () => this.showFormView());
            document.getElementById('create-first-inventory').addEventListener('click', () => this.showFormView());
            document.getElementById('back-to-list').addEventListener('click', () => this.showListView());
            document.getElementById('cancel-form').addEventListener('click', () => this.showListView());

            // Form
            // document.getElementById('inventory-form').addEventListener('submit', (e) => this.handleFormSubmit(e));
            // document.getElementById('add-item-btn').addEventListener('click', () => this.addInventoryItem());

            // Search and Pagination

            // Search and Pagination
            const searchInput = document.getElementById('search-input');

            searchInput.addEventListener('input',
                this.debounce((e) => this.handleSearch(e), 400)
            );

            // page -> modified

            document.getElementById('prev-page').addEventListener('click', () => {
                if (this.currentPage > 1) {
                    this.loadInventories(this.currentPage - 1);
                }
            });

            document.getElementById('next-page').addEventListener('click', () => {
                if (this.currentPage < this.totalPages) {
                    this.loadInventories(this.currentPage + 1);
                }
            });

            // page -> modified

        }

        /**
         * Price formatter (clean format)
         */
        formatPrice(value) {
            return Number(value || 0).toLocaleString('en-US', {
                maximumFractionDigits: 0
            });
        }
        // search
        debounce(fn, delay = 300) {
            let timeout;

            return (...args) => {
                clearTimeout(timeout);
                timeout = setTimeout(() => {
                    fn.apply(this, args);
                }, delay);
            };
        }

        async loadInventories(page = 1) {
            try {
                this.isLoading = true;
                this.showLoadingState();

                const response = await fetch(
                    `${this.apiBase}/inventory?page=${page}&search=${this.searchTerm}`
                );

                const data = await response.json();

                console.log("API Response:", data); // Debug

                this.inventories = data.data || [];
                this.currentPage = data.current_page || 1;
                this.totalPages = data.last_page || 1;
                this.perPage = data.per_page || 10; // <-- add this
                this.totalResults = data.total || 0;

                this.renderInventoriesList();
                this.updatePagination();

            } catch (error) {
                console.error("Failed to load wholesales:", error);
                this.showErrorState();
            } finally {
                this.isLoading = false;
            }
        }

        async loadProducts() {}


        // pagenation
        updatePagination() {
            // defensive defaults
            const perPage = this.perPage || 10;
            const total = this.totalResults || 0;
            const current = this.currentPage || 1;
            const last = this.totalPages || Math.ceil(total / perPage) || 1;

            const from = total === 0 ? 0 : (current - 1) * perPage + 1;
            const to = Math.min(current * perPage, total);

            const paginationFrom = document.getElementById('pagination-from');
            const paginationTo = document.getElementById('pagination-to');
            const paginationTotal = document.getElementById('pagination-total');
            const paginationContainer = document.getElementById('pagination-container');

            if (paginationFrom) paginationFrom.textContent = from;
            if (paginationTo) paginationTo.textContent = to;
            if (paginationTotal) paginationTotal.textContent = total;

            if (paginationContainer) paginationContainer.style.display = total === 0 ? 'none' : 'flex';

            // enable/disable buttons visually and semantically
            const prevBtn = document.getElementById('prev-page');
            const nextBtn = document.getElementById('next-page');
            if (prevBtn) prevBtn.disabled = current <= 1;
            if (nextBtn) nextBtn.disabled = current >= last;
        }



        //   UI
        showLoadingState() {
            document.getElementById('loading-state').style.display = 'block';
            document.getElementById('inventory-table').style.display = 'none';
            document.getElementById('empty-state').classList.add('hidden');
            document.getElementById('pagination-container').style.display = 'none';
        }

        showErrorState() {
            document.getElementById('loading-state').innerHTML = `
                    <div class="text-center text-red-600">
                        <i class="fas fa-exclamation-triangle text-2xl mb-2"></i>
                        <p>Failed to load inventory data</p>
                        <button class="mt-2 px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700" onclick="window.inventoryResource.loadInventories()">
                            Retry
                        </button>
                    </div>
                `;
        }

        renderInventoriesList() {
            const tbody = document.getElementById('inventory-table-body');
            tbody.innerHTML = '';

            if (this.inventories.length === 0) {
                this.showEmptyState();
                return;
            }

            this.inventories.forEach(inventory => {
                const row = this.createInventoryRow(inventory);
                tbody.appendChild(row);
            });

            const loadingState = document.getElementById('loading-state');
            const inventoryTable = document.getElementById('inventory-table');
            const emptyState = document.getElementById('empty-state');

            if (loadingState) loadingState.style.display = 'none';
            if (inventoryTable) inventoryTable.style.display = 'table';
            if (emptyState) emptyState.classList.add('hidden');
        }


        createInventoryRow(inventory) {
            const row = document.createElement('tr');
            row.className = 'table-row fade-in';

            const statusBadge = inventory.status === 'paid' ?
                '<span class="status-badge bg-green-100 text-green-800">Paid</span>' :
                inventory.status === 'pending' ?
                '<span class="status-badge bg-yellow-100 text-yellow-800">Pending</span>' :
                '<span class="status-badge bg-red-100 text-red-800">Cancelled</span>';

            const paymentBadge = this.getPaymentBadge(inventory.payment_method);

            row.innerHTML = `
                      <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="h-10 w-10 bg-blue-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-boxes-stacked text-blue-500"></i>
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-medium text-gray-900">${inventory.supplier}</div>
                                <div class="text-sm text-gray-500">${inventory.note || 'No notes'}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">${this.formatPrice(inventory.grand_total)}</td>
                    <td class="px-6 py-4 whitespace-nowrap">${paymentBadge}</td>
                    <td class="px-6 py-4 whitespace-nowrap">${statusBadge}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">5 items</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${new Date(inventory.created_at).toLocaleDateString()}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <button class="text-green-600 hover:text-green-900 mr-3 edit-inventory" data-id="${inventory.id}">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="text-red-600 hover:text-red-900 delete-inventory" data-id="${inventory.id}">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                `;

            // Add event listeners
            row.querySelector('.edit-inventory').addEventListener('click', () => {
                this.showFormView(inventory.id);
            });

            row.querySelector('.delete-inventory').addEventListener('click', () => {
                this.deleteInventory(inventory.id);
            });

            return row;
        }

        getPaymentBadge(method) {
            const badges = {
                'cash': 'bg-green-100 text-green-800',
                'bank': 'bg-blue-100 text-blue-800',
                'cheque': 'bg-purple-100 text-purple-800',
                'credit': 'bg-yellow-100 text-yellow-800',
                'mpesa': 'bg-red-100 text-blue-800'
            };

            return `<span class="payment-badge ${badges[method]}">${method}</span>`;
        }

        showEmptyState() {
            document.getElementById('loading-state').style.display = 'none';
            document.getElementById('inventory-table').style.display = 'none';
            document.getElementById('empty-state').classList.remove('hidden');
            document.getElementById('pagination-container').style.display = 'none';
        }

        // FORM
        showListView() {
            this.currentView = 'list';
            document.getElementById('list-view').classList.remove('hidden');
            document.getElementById('form-view').classList.add('hidden');
            document.getElementById('page-title').textContent = 'Inventory';
            document.getElementById('page-description').textContent = 'Manage your stock purchases and suppliers';
        }

        showFormView(inventoryId = null) {
            this.currentView = 'form';
            this.currentInventoryId = inventoryId;

            document.getElementById('list-view').classList.add('hidden');
            document.getElementById('form-view').classList.remove('hidden');

            if (inventoryId) {
                document.getElementById('form-title').textContent = 'Edit Inventory Purchase';
                this.loadInventoryForEdit(inventoryId);
            } else {
                document.getElementById('form-title').textContent = 'New Inventory Purchase';
                this.resetForm();
            }
        }

        resetForm() {
            document.getElementById('inventory-form').reset();
            //  document.getElementById('inventory-items-container').innerHTML = '';
            //  this.addInventoryItem(); // Add one empty item
            //  this.updateTotals();
        }

    }


    // Initialize the inventory resource when page loads
    document.addEventListener('DOMContentLoaded', function() {
        window.inventoryResource = new InventoryResource();

        // Add fade-in animation to all stat cards
        const cards = document.querySelectorAll('.fade-in');
        cards.forEach((card, index) => {
            card.style.animationDelay = `${index * 0.1}s`;
        });
    });
</script>
