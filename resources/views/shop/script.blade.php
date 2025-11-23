 <script type="module">
     class ProductResource {
         constructor() {
             this.currentView = 'list';
             this.products = [];
             this.currentPage = 1;
             this.totalPages = 1;
             this.searchTerm = '';
             this.isLoading = false;
             //  this.isSidebarCollapsed = false;

             this.initializeEventListeners();
             this.loadProducts();
         }

         //  functions
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
         //  // search

         handleSearch(e) {
             this.searchTerm = e.target.value.trim().toLowerCase();
             console.log('Searching for:', this.searchTerm);

             // Reset to first page when searching
             this.currentPage = 1;

             // Call API with new search term
             this.loadProducts(1);
         }


         //  initialize
         initializeEventListeners() {
             // Navigation
             document.getElementById('create-product-btn').addEventListener('click', () => this.showFormView());
             document.getElementById('create-first-product').addEventListener('click', () => this.showFormView());
             document.getElementById('back-to-list').addEventListener('click', () => this.showListView());
             document.getElementById('cancel-form').addEventListener('click', () => this.showListView());

             // Form
             document.getElementById('product-form').addEventListener('submit', (e) => this.handleFormSubmit(e));

             //
             // Search and Pagination
             const searchInput = document.getElementById('search-input');

             searchInput.addEventListener('input',
                 this.debounce((e) => this.handleSearch(e), 400)
             );

             // page -> modified

             document.getElementById('prev-page').addEventListener('click', () => {
                 if (this.currentPage > 1) {
                     this.loadProducts(this.currentPage - 1);
                 }
             });

             document.getElementById('next-page').addEventListener('click', () => {
                 if (this.currentPage < this.totalPages) {
                     this.loadProducts(this.currentPage + 1);
                 }
             });
             // page -> modified

             // Export
             document.getElementById('export-btn').addEventListener('click', () => this.exportProducts());

         }


         //1. load products
         async loadProducts(page = 1) {
             this.isLoading = true;
             this.showLoadingState();

             try {
                 const response = await fetch(`/api/product?page=${page}&search=${this.searchTerm}`);
                 const data = await response.json();

                 this.products = data.data;
                 this.currentPage = data.current_page;
                 this.totalPages = data.last_page;
                 this.totalItems = data.total;
                 this.perPage = data.per_page;
                 this.from = data.from;
                 this.to = data.to;

                 this.renderProductsList();
                 this.updatePagination();
             } catch (error) {
                 console.error("Error:", error);
             } finally {
                 this.isLoading = false;
             }
         }

         // 2.  pagenation
         updatePagination() {
             document.getElementById('pagination-from').textContent = this.from ?? 0;
             document.getElementById('pagination-to').textContent = this.to ?? 0;

             if (document.getElementById('pagination-total')) {
                 document.getElementById('pagination-total').textContent = this.totalItems;
             }

             document.getElementById('prev-page').disabled = this.currentPage === 1;
             document.getElementById('next-page').disabled = this.currentPage === this.totalPages;

             document.getElementById('pagination-container').style.display =
                 this.totalItems > 0 ? 'flex' : 'none';
         }

         // 3. renderlist
         renderProductsList() {
             const tbody = document.getElementById('products-table-body');
             tbody.innerHTML = '';

             if (this.products.length === 0) {
                 this.showEmptyState();
                 return;
             }

             this.products.forEach(product => {
                 const row = this.createProductRow(product);
                 tbody.appendChild(row);
             });

             document.getElementById('loading-state').style.display = 'none';
             document.getElementById('products-table').style.display = 'table';
             document.getElementById('empty-state').classList.add('hidden');
         }

         createProductRow(product) {
             const row = document.createElement('tr');
             row.className = 'table-row fade-in';

             row.innerHTML = `
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="h-10 w-10 bg-blue-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-cube text-blue-500"></i>
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-medium text-gray-900">${product.name}</div>
                                <div class="text-sm text-gray-500">stock -  ${product.stock || 'No stock'}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-red-600"> ${this.formatPrice(product.price)}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-green-500">${this.formatPrice(product.wholesale_price)}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${this.formatPrice(product.buying_price)}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${new Date(product.created_at).toLocaleDateString()}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <button class="text-green-600 hover:text-green-900 mr-3 edit-product" data-id="${product.id}">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="text-red-600 hover:text-red-900 delete-product" data-id="${product.id}">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                `;

             // Add event listeners
             row.querySelector('.edit-product').addEventListener('click', () => {
                 this.showFormView(product.id);
             });

             row.querySelector('.delete-product').addEventListener('click', () => {
                 this.deleteProduct(product.id);
             });

             return row;
         }


        //  UI
         showEmptyState() {
             document.getElementById('loading-state').style.display = 'none';
             document.getElementById('products-table').style.display = 'none';
             document.getElementById('empty-state').classList.remove('hidden');
             document.getElementById('pagination-container').style.display = 'none';
         }


         showLoadingState() {
             document.getElementById('loading-state').style.display = 'block';
             document.getElementById('products-table').style.display = 'none';
             document.getElementById('empty-state').classList.add('hidden');
             document.getElementById('pagination-container').style.display = 'none';
         }

         showErrorState() {
             document.getElementById('loading-state').innerHTML = `
                    <div class="text-center text-red-600">
                        <i class="fas fa-exclamation-triangle text-2xl mb-2"></i>
                        <p>Failed to load Products</p>
                        <button class="mt-2 px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700" onclick="window.productsResource.loadProducts()">
                            Retry
                        </button>
                    </div>
                `;
         }

         showListView() {
             this.currentView = 'list';
             document.getElementById('list-view').classList.remove('hidden');
             document.getElementById('form-view').classList.add('hidden');
             document.getElementById('page-title').textContent = 'Products';
             document.getElementById('page-description').textContent =
             'Manage business products and track inventory';
         }

         showFormView(productId = null) {
             this.currentView = 'form';
             this.currentProductId = productId;

             document.getElementById('list-view').classList.add('hidden');
             document.getElementById('form-view').classList.remove('hidden');

             if (productId) {
                 document.getElementById('form-title').textContent = 'Edit Products';
                 this.loadProductForEdit(productId);
             } else {
                 document.getElementById('form-title').textContent = 'New Products';
                 this.resetForm();
             }
         }

         resetForm() {
             document.getElementById('product-form').reset();
         }



        //  LOGICS
         async loadProductForEdit(productId) {
             // In real app, this would fetch from API
             const product = this.product.find(e => e.id === productId);
             if (product) {
                 document.getElementById('name').value = product.name;
                 document.getElementById('price').value = product.price;
                 document.getElementById('wholesale_price').value = product.wholesale_price;
                 document.getElementById('buying_price').value = product.buying_price || '';
                 //  document.getElementById('notes').value = product.notes || '';
             }
         }



         async handleFormSubmit(e) {
             e.preventDefault();

             const payload = {
                 name: document.getElementById("name").value,
                 price: document.getElementById("price").value,
                 wholesale_price: document.getElementById("wholesale_price").value,
                 buying_price: document.getElementById("buying_price").value,
                 //  notes: document.getElementById("notes").value,
             };

             let url = "/api/products";
             let method = "POST";

             if (this.editingId) {
                 url = `/api/products/${this.editingId}`;
                 method = "PUT";
             }

             await fetch(url, {
                 method: method,
                 headers: {
                     "Content-Type": "application/json"
                 },
                 body: JSON.stringify(payload),
             });

             this.showListView();
             this.loadProducts();
             this.loadStats();
         }

         async createProduct(productData) {
             // Simulate API call
             await new Promise(resolve => setTimeout(resolve, 1000));
             console.log('Creating Products:', productData);
             alert('Products created successfully!');
             this.showListView();
             this.loadProducts(); // Refresh the list
             this.loadStats();
         }

         async updateProduct(productId, productData) {
             // Simulate API call
             await new Promise(resolve => setTimeout(resolve, 1000));
             console.log('Updating Product:', productId, productData);
             alert('Product updated successfully!');
             this.showListView();
             this.loadProducts(); // Refresh the list
             this.loadStats();
         }

         async deleteProduct(productId) {
             if (!confirm('Are you sure you want to delete this Product?')) {
                 return;
             }

             try {
                 // Simulate API call
                 await new Promise(resolve => setTimeout(resolve, 800));
                 console.log('Deleting Product:', productId);
                 alert('Product deleted successfully!');
                 this.loadProducts(); // Refresh the list
                 this.loadStats();
             } catch (error) {
                 console.error('Error deleting product:', error);
                 alert('Error deleting product. Please try again.');
             }
         }

         exportProducts() {
             console.log('Exporting products data...');
             alert('Products export started! You will receive the file shortly.');
         }


     }

     // Initialize the product resource when page loads
     document.addEventListener('DOMContentLoaded', function() {
         window.productsResource = new ProductResource();

         // Add fade-in animation to all stat cards
         const cards = document.querySelectorAll('.fade-in');
         cards.forEach((card, index) => {
             card.style.animationDelay = `${index * 0.1}s`;
         });
     });
 </script>
