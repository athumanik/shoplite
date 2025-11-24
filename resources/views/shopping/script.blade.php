  <script>
      class WholesaleResource {
          constructor() {
              this.apiBase = "/api";
              this.currentView = 'list';
              this.wholesales = [];
              this.products = [];


              this.currentPage = 1;
              this.totalPages = 1;
              this.searchTerm = '';
              this.isLoading = false;
              this.currentWholesaleId = null;

              // Wait for DOM to be ready before initializing
              if (document.readyState === 'loading') {
                  document.addEventListener('DOMContentLoaded', () => this.initialize());
              } else {
                  this.initialize();
              }
          }


          initialize() {
              this.initializeEventListeners();
              this.loadWholesales();
              //   this.loadProducts();
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

          async loadWholesales(page = 1) {
              try {
                  this.isLoading = true;
                  this.showLoadingState();

                  const response = await fetch(
                      `${this.apiBase}/wholesales?page=${page}&search=${this.searchTerm}`
                  );

                  const result = await response.json();

                  console.log("API Response:", result); // Debug

                  this.wholesales = result.data || [];
                  this.currentPage = result.current_page || 1;
                  this.totalPages = result.last_page || 1;
                  this.perPage = result.per_page || 10; // <-- add this
                  this.totalResults = result.total || 0;

                  this.renderWholesalesList();
                  this.updatePagination();

              } catch (error) {
                  console.error("Failed to load wholesales:", error);
                  this.showErrorState();
              } finally {
                  this.isLoading = false;
              }
          }


          renderWholesalesList() {
              const tbody = document.getElementById('wholesale-table-body');
              if (!tbody) return;

              tbody.innerHTML = '';


              if (this.wholesales.length === 0) {
                  this.showEmptyState();
                  return;
              }

              this.wholesales.forEach(wholesale => {
                  const row = this.createWholesaleRow(wholesale);
                  tbody.appendChild(row);
              });

              const loadingState = document.getElementById('loading-state');
              const wholesaleTable = document.getElementById('wholesale-table');
              const emptyState = document.getElementById('empty-state');

              if (loadingState) loadingState.style.display = 'none';
              if (wholesaleTable) wholesaleTable.style.display = 'table';
              if (emptyState) emptyState.classList.add('hidden');
          }


          //   UI
          createWholesaleRow(wholesale) {
              const row = document.createElement('tr');
              row.className = 'table-row fade-in';

              row.innerHTML = `
                 <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="h-10 w-10 bg-blue-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-wheat-alt text-blue-500"></i>
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-medium text-gray-900">${wholesale.customer}</div>
                                <div class="text-sm text-gray-500">${wholesale.note || 'No notes'}</div>
                            </div>
                        </div>
                    </td>

            <td class="px-4 sm:px-6 py-4 whitespace-nowrap text-sm font-bold text-green-600"> ${parseFloat(wholesale.grand_total).toLocaleString()}</td>
             <td class="px-4 sm:px-6 py-4 whitespace-nowrap text-sm text-gray-500 hidden md:table-cell">10 items</td>
            <td class="px-4 sm:px-6 py-4 whitespace-nowrap text-sm text-gray-500 hidden sm:table-cell">${new Date(wholesale.created_at).toLocaleDateString()}</td>


            <td class="px-4 sm:px-6 py-4 whitespace-nowrap text-sm font-medium">
                <button class="text-green-600 hover:text-green-900 mr-3 edit-wholesale" data-id="${wholesale.id}">
                    <i class="fas fa-edit"></i>
                </button>
                <button class="text-red-600 hover:text-red-900 delete-wholesale" data-id="${wholesale.id}">
                    <i class="fas fa-trash"></i>
                </button>
            </td>
        `;

              // Add event listeners to the buttons in this row
              const editBtn = row.querySelector('.edit-wholesale');
              const deleteBtn = row.querySelector('.delete-wholesale');

              // if (editBtn) {
              //     editBtn.addEventListener('click', () => {
              //         this.showFormView(wholesale.id);
              //     });
              // }

              // if (deleteBtn) {
              //     deleteBtn.addEventListener('click', () => {
              //         this.deleteWholesale(wholesale.id);
              //     });
              // }

              return row;
          }


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
              const loadingState = document.getElementById('loading-state');
              const wholesaleTable = document.getElementById('wholesale-table');
              const emptyState = document.getElementById('empty-state');
              const paginationContainer = document.getElementById('pagination-container');

              if (loadingState) loadingState.style.display = 'block';
              if (wholesaleTable) wholesaleTable.style.display = 'none';
              if (emptyState) emptyState.classList.add('hidden');
              if (paginationContainer) paginationContainer.style.display = 'none';
          }

          showErrorState() {
              const loadingState = document.getElementById('loading-state');
              if (loadingState) {
                  loadingState.innerHTML = `
                <div class="text-center text-red-600">
                    <i class="fas fa-exclamation-triangle text-2xl mb-2"></i>
                    <p>Failed to load wholesale orders</p>
                    <button class="mt-2 px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700" onclick="window.wholesaleResource.loadWholesales()">
                        Retry
                    </button>
                </div>
            `;
              }
          }

             //  // search
         handleSearch(e) {
             this.searchTerm = e.target.value.trim().toLowerCase();
             console.log('Searching for:', this.searchTerm);

             // Reset to first page when searching
             this.currentPage = 1;

             // Call API with new search term
             this.loadWholesales(1);
         }

          initializeEventListeners() {
              // Safe event listener attachment with null checks
              this.safeAddEventListener('create-wholesale-btn', 'click', () => this.showFormView());
              this.safeAddEventListener('create-first-wholesale', 'click', () => this.showFormView());
              this.safeAddEventListener('back-to-list', 'click', () => this.showListView());
              this.safeAddEventListener('cancel-form', 'click', () => this.showListView());

              // Form submission
              const wholesaleForm = document.getElementById('wholesale-form');
              if (wholesaleForm) {
                  wholesaleForm.addEventListener('submit', (e) => this.handleFormSubmit(e));
              }

              // Search functionality
              this.safeAddEventListener('product-search', 'input',
                  this.debounce((e) => this.handleProductSearch(e), 300)
              );
              this.safeAddEventListener('mobile-product-search', 'input',
                  this.debounce((e) => this.handleMobileProductSearch(e), 300)
              );
              this.safeAddEventListener('mobile-search-trigger', 'click', () => this.showMobileSearch());
              this.safeAddEventListener('close-mobile-search', 'click', () => this.hideMobileSearch());

              // Search and Pagination
              const searchInput = document.getElementById('search-input');

              searchInput.addEventListener('input',
                  this.debounce((e) => this.handleSearch(e), 400)
              );


              // page -> modified

              document.getElementById('prev-page').addEventListener('click', () => {
                  if (this.currentPage > 1) {
                      this.loadWholesales(this.currentPage - 1);
                  }
              });

              document.getElementById('next-page').addEventListener('click', () => {
                  if (this.currentPage < this.totalPages) {
                      this.loadWholesales(this.currentPage + 1);
                  }
              });

              // page -> modified

              // Export
              this.safeAddEventListener('export-btn', 'click', () => this.exportWholesales());


              // Close search dropdown when clicking outside
              document.addEventListener('click', (e) => {
                  if (!e.target.closest('#product-search') && !e.target.closest('#search-results')) {
                      const searchResults = document.getElementById('search-results');
                      if (searchResults) {
                          searchResults.classList.add('hidden');
                      }
                  }
              });
          }

          // Helper method to safely add event listeners
          safeAddEventListener(elementId, event, handler) {
              const element = document.getElementById(elementId);
              if (element) {
                  element.addEventListener(event, handler);
              } else {
                  console.warn(`Element with id '${elementId}' not found`);
              }
          }

        //   handleFormSubmit
         showListView() {
              const listView = document.getElementById('list-view');
              const formView = document.getElementById('form-view');
              const pageTitle = document.getElementById('page-title');
              const pageDescription = document.getElementById('page-description');

              if (listView) listView.classList.remove('hidden');
              if (formView) formView.classList.add('hidden');
              if (pageTitle) pageTitle.textContent = 'Wholesale Sales';
              if (pageDescription) pageDescription.textContent = 'Bulk orders and wholesale transactions';

              this.currentView = 'list';
          }

          showFormView(wholesaleId = null) {
              const listView = document.getElementById('list-view');
              const formView = document.getElementById('form-view');
              const formTitle = document.getElementById('form-title');

              if (listView) listView.classList.add('hidden');
              if (formView) formView.classList.remove('hidden');

              this.currentView = 'form';
              this.currentWholesaleId = wholesaleId;

              if (wholesaleId) {
                  if (formTitle) formTitle.textContent = 'Edit Wholesale Order';
                  this.loadWholesaleForEdit(wholesaleId);
              } else {
                  if (formTitle) formTitle.textContent = 'New Wholesale Order';
                  this.resetForm();
              }
          }

          resetForm() {
              const wholesaleForm = document.getElementById('wholesale-form');
              const itemsContainer = document.getElementById('wholesale-items-container');
              const customerInput = document.getElementById('customer');

              if (wholesaleForm) wholesaleForm.reset();
              if (itemsContainer) itemsContainer.innerHTML = '';
              if (customerInput) customerInput.value = 'Wholesale Customer';
            //   this.updateTotals();
          }



      }

      // Initialize the wholesale resource when page loads
      document.addEventListener('DOMContentLoaded', function() {
          window.wholesaleResource = new WholesaleResource();

          // Add fade-in animation to all stat cards
          const cards = document.querySelectorAll('.fade-in');
          cards.forEach((card, index) => {
              card.style.animationDelay = `${index * 0.1}s`;
          });
      });
  </script>
