<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POS - Agrovet</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        .pos-container {
            height: 100vh;
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
        }
        .product-card:hover {
            transform: translateY(-2px);
            transition: all 0.2s ease;
        }
        .cart-item {
            border-bottom: 1px solid #e2e8f0;
        }
        .cart-item:last-child {
            border-bottom: none;
        }
        .search-input:focus {
            box-shadow: 0 0 0 3px rgba(34, 197, 94, 0.1);
        }
        .category-btn.active {
            background-color: #16a34a;
            color: white;
        }
        .number-btn:active {
            transform: scale(0.95);
        }
    </style>
</head>
<body class="antialiased">
    <!-- POS Interface -->
    <div class="pos-container flex flex-col">
        <!-- Header -->
        <header class="bg-white shadow-sm border-b border-gray-200">
            <div class="px-6 py-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <div class="flex items-center">
                          <a href="{{ route('dashboard') }}" > <svg class="h-8 w-8 text-green-600" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 2L3 9V20C3 20.5304 3.21071 21.0391 3.58579 21.4142C3.96086 21.7893 4.46957 22 5 22H19C19.5304 22 20.0391 21.7893 20.4142 21.4142C20.7893 21.0391 21 20.5304 21 20V9L12 2Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M9 22V12H15V22" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M9 12H15" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg> </a>
                            <span class="ml-2 text-xl font-bold text-gray-800">Shoplite Agrovet POS</span>
                        </div>
                        <div class="text-sm text-gray-500">
                            <span id="current-date"></span>
                        </div>
                    </div>
                    <div class="flex items-center space-x-4">
                        <div class="text-right">
                            <div class="text-sm font-medium text-gray-900"> {{ $user->name }}</div>
                            <div class="text-xs text-gray-500">Agrovet {{ $user->role_title }}</div>
                        </div>
                        <div class="h-10 w-10 rounded-full bg-green-100 flex items-center justify-center">
                            <span class="text-green-600 font-medium"> {{ $user->initials }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!-- Main POS Content -->
        <div class="flex flex-1 overflow-hidden">
            <!-- Products Section -->
            <div class="flex-1 flex flex-col">
                <!-- Search and Categories -->
                <div class="bg-white border-b border-gray-200 p-4">
                    <div class="flex space-x-4">
                        <div class="flex-1">
                            <div class="relative">
                                <input type="text"
                                    class="search-input w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                                    placeholder="Search products...">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-search text-gray-400"></i>
                                </div>
                            </div>
                        </div>
                        <button class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
                            <i class="fas fa-barcode mr-2"></i>Scan
                        </button>
                    </div>

                    <!-- Categories -->
                    <div class="flex space-x-2 mt-4 overflow-x-auto pb-2">
                        <button class="category-btn active px-4 py-2 bg-gray-100 text-gray-700 rounded-lg text-sm font-medium whitespace-nowrap">
                            All Products
                        </button>
                        <button class="category-btn px-4 py-2 bg-gray-100 text-gray-700 rounded-lg text-sm font-medium whitespace-nowrap">
                            Animal Health
                        </button>
                        <button class="category-btn px-4 py-2 bg-gray-100 text-gray-700 rounded-lg text-sm font-medium whitespace-nowrap">
                            Crop Protection
                        </button>
                        <button class="category-btn px-4 py-2 bg-gray-100 text-gray-700 rounded-lg text-sm font-medium whitespace-nowrap">
                            Feeds & Supplements
                        </button>
                        <button class="category-btn px-4 py-2 bg-gray-100 text-gray-700 rounded-lg text-sm font-medium whitespace-nowrap">
                            Farming Equipment
                        </button>
                    </div>
                </div>

                <!-- Products Grid -->
                <div class="flex-1 overflow-y-auto p-4">
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
                        <!-- Product 1 -->
                        <div class="product-card bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden cursor-pointer">
                            <div class="h-32 bg-green-50 flex items-center justify-center">
                                <i class="fas fa-syringe text-4xl text-green-600"></i>
                            </div>
                            <div class="p-4">
                                <h3 class="font-medium text-gray-900">Livestock Vaccine</h3>
                                <p class="text-sm text-gray-500 mt-1">Animal Health</p>
                                <div class="flex items-center justify-between mt-3">
                                    <span class="text-lg font-bold text-green-600">24,990</span>
                                    <span class="text-xs text-gray-500">Stock: 45</span>
                                </div>
                                <button class="w-full mt-3 bg-green-600 text-white py-2 rounded-lg hover:bg-green-700 transition-colors">
                                    Add to Cart
                                </button>
                            </div>
                        </div>

                        <!-- Product 2 -->
                        <div class="product-card bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden cursor-pointer">
                            <div class="h-32 bg-blue-50 flex items-center justify-center">
                                <i class="fas fa-spray-can text-4xl text-blue-600"></i>
                            </div>
                            <div class="p-4">
                                <h3 class="font-medium text-gray-900">Organic Fertilizer</h3>
                                <p class="text-sm text-gray-500 mt-1">Crop Protection</p>
                                <div class="flex items-center justify-between mt-3">
                                    <span class="text-lg font-bold text-green-600">19,990</span>
                                    <span class="text-xs text-gray-500">Stock: 32</span>
                                </div>
                                <button class="w-full mt-3 bg-green-600 text-white py-2 rounded-lg hover:bg-green-700 transition-colors">
                                    Add to Cart
                                </button>
                            </div>
                        </div>

                        <!-- Product 3 -->
                        <div class="product-card bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden cursor-pointer">
                            <div class="h-32 bg-yellow-50 flex items-center justify-center">
                                <i class="fas fa-wheat-alt text-4xl text-yellow-600"></i>
                            </div>
                            <div class="p-4">
                                <h3 class="font-medium text-gray-900">Premium Animal Feed</h3>
                                <p class="text-sm text-gray-500 mt-1">Feeds & Supplements</p>
                                <div class="flex items-center justify-between mt-3">
                                    <span class="text-lg font-bold text-green-600">34,999</span>
                                    <span class="text-xs text-gray-500">Stock: 67</span>
                                </div>
                                <button class="w-full mt-3 bg-green-600 text-white py-2 rounded-lg hover:bg-green-700 transition-colors">
                                    Add to Cart
                                </button>
                            </div>
                        </div>

                        <!-- Product 4 -->
                        <div class="product-card bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden cursor-pointer">
                            <div class="h-32 bg-purple-50 flex items-center justify-center">
                                <i class="fas fa-tools text-4xl text-purple-600"></i>
                            </div>
                            <div class="p-4">
                                <h3 class="font-medium text-gray-900">Farm Sprayer</h3>
                                <p class="text-sm text-gray-500 mt-1">Farming Equipment</p>
                                <div class="flex items-center justify-between mt-3">
                                    <span class="text-lg font-bold text-green-600">8,999</span>
                                    <span class="text-xs text-gray-500">Stock: 12</span>
                                </div>
                                <button class="w-full mt-3 bg-green-600 text-white py-2 rounded-lg hover:bg-green-700 transition-colors">
                                    Add to Cart
                                </button>
                            </div>
                        </div>

                        <!-- Product 5 -->
                        <div class="product-card bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden cursor-pointer">
                            <div class="h-32 bg-red-50 flex items-center justify-center">
                                <i class="fas fa-pills text-4xl text-red-600"></i>
                            </div>
                            <div class="p-4">
                                <h3 class="font-medium text-gray-900">Antibiotics</h3>
                                <p class="text-sm text-gray-500 mt-1">Animal Health</p>
                                <div class="flex items-center justify-between mt-3">
                                    <span class="text-lg font-bold text-green-600">15,999</span>
                                    <span class="text-xs text-gray-500">Stock: 28</span>
                                </div>
                                <button class="w-full mt-3 bg-green-600 text-white py-2 rounded-lg hover:bg-green-700 transition-colors">
                                    Add to Cart
                                </button>
                            </div>
                        </div>

                        <!-- Product 6 -->
                        <div class="product-card bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden cursor-pointer">
                            <div class="h-32 bg-indigo-50 flex items-center justify-center">
                                <i class="fas fa-seedling text-4xl text-indigo-600"></i>
                            </div>
                            <div class="p-4">
                                <h3 class="font-medium text-gray-900">Herbicide</h3>
                                <p class="text-sm text-gray-500 mt-1">Crop Protection</p>
                                <div class="flex items-center justify-between mt-3">
                                    <span class="text-lg font-bold text-green-600">22,500</span>
                                    <span class="text-xs text-gray-500">Stock: 41</span>
                                </div>
                                <button class="w-full mt-3 bg-green-600 text-white py-2 rounded-lg hover:bg-green-700 transition-colors">
                                    Add to Cart
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Cart Section -->
            <div class="w-96 bg-white border-l border-gray-200 flex flex-col">
                <!-- Cart Header -->
                <div class="p-4 border-b border-gray-200">
                    <h2 class="text-lg font-bold text-gray-900">Current Sale</h2>
                    <div class="flex items-center justify-between mt-2">
                        <span class="text-sm text-gray-500">Transaction #TXN-001</span>
                        <button class="text-green-600 hover:text-green-700">
                            <i class="fas fa-redo"></i>
                        </button>
                    </div>
                </div>

                <!-- Cart Items -->
                <div class="flex-1 overflow-y-auto p-4">
                    <div class="space-y-3">
                        <!-- Cart Item 1 -->
                        <div class="cart-item p-3 bg-gray-50 rounded-lg">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h4 class="font-medium text-gray-900">Livestock Vaccine</h4>
                                    <p class="text-sm text-gray-500">24,999 × 2</p>
                                </div>
                                <div class="text-right">
                                    <div class="font-bold text-gray-900">49,998</div>
                                    <div class="flex items-center space-x-2 mt-1">
                                        <button class="w-6 h-6 rounded-full bg-gray-200 flex items-center justify-center">
                                            <i class="fas fa-minus text-xs"></i>
                                        </button>
                                        <span class="text-sm">2</span>
                                        <button class="w-6 h-6 rounded-full bg-gray-200 flex items-center justify-center">
                                            <i class="fas fa-plus text-xs"></i>
                                        </button>
                                        <button class="text-red-500 ml-2">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Cart Item 2 -->
                        <div class="cart-item p-3 bg-gray-50 rounded-lg">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h4 class="font-medium text-gray-900">Organic Fertilizer</h4>
                                    <p class="text-sm text-gray-500">19,999 × 1</p>
                                </div>
                                <div class="text-right">
                                    <div class="font-bold text-gray-900">19,999</div>
                                    <div class="flex items-center space-x-2 mt-1">
                                        <button class="w-6 h-6 rounded-full bg-gray-200 flex items-center justify-center">
                                            <i class="fas fa-minus text-xs"></i>
                                        </button>
                                        <span class="text-sm">1</span>
                                        <button class="w-6 h-6 rounded-full bg-gray-200 flex items-center justify-center">
                                            <i class="fas fa-plus text-xs"></i>
                                        </button>
                                        <button class="text-red-500 ml-2">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Cart Summary -->
                <div class="p-4 border-t border-gray-200 space-y-4">
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-600">Subtotal</span>
                        <span class="font-medium">69,997</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-600">Tax (8%)</span>
                        <span class="font-medium">5600</span>
                    </div>
                    <div class="flex justify-between text-lg font-bold border-t pt-2">
                        <span>Total</span>
                        <span>75,957</span>
                    </div>

                    <!-- Payment Methods -->
                    <div class="grid grid-cols-2 gap-2">
                        <button class="p-3 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
                            <i class="fas fa-credit-card mr-2"></i>Card
                        </button>
                        <button class="p-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                            <i class="fas fa-money-bill-wave mr-2"></i>Cash
                        </button>
                        <button class="p-3 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-colors">
                            <i class="fas fa-mobile-alt mr-2"></i>Mobile
                        </button>
                        <button class="p-3 bg-yellow-600 text-white rounded-lg hover:bg-yellow-700 transition-colors">
                            <i class="fas fa-handshake mr-2"></i>Credit
                        </button>
                    </div>

                    <!-- Action Buttons -->
                    <div class="grid grid-cols-2 gap-2">
                        <button class="p-3 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors">
                            Hold Sale
                        </button>
                        <button class="p-3 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors">
                            Cancel
                        </button>
                    </div>

                    <!-- Complete Sale -->
                    <button class="w-full p-4 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors font-bold text-lg">
                        Complete Sale
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Set current date
        document.getElementById('current-date').textContent = new Date().toLocaleDateString('en-US', {
            weekday: 'long',
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        });

        // Category buttons functionality
        document.querySelectorAll('.category-btn').forEach(button => {
            button.addEventListener('click', function() {
                document.querySelectorAll('.category-btn').forEach(btn => {
                    btn.classList.remove('active');
                    btn.classList.add('bg-gray-100', 'text-gray-700');
                    btn.classList.remove('bg-green-600', 'text-white');
                });
                this.classList.add('active');
                this.classList.remove('bg-gray-100', 'text-gray-700');
                this.classList.add('bg-green-600', 'text-white');
            });
        });

        // Add to cart functionality
        document.querySelectorAll('.product-card button').forEach(button => {
            button.addEventListener('click', function() {
                const productCard = this.closest('.product-card');
                const productName = productCard.querySelector('h3').textContent;
                const productPrice = productCard.querySelector('.text-lg').textContent;

                // Show success feedback
                const originalText = this.textContent;
                this.textContent = 'Added!';
                this.classList.remove('bg-green-600');
                this.classList.add('bg-green-500');

                setTimeout(() => {
                    this.textContent = originalText;
                    this.classList.remove('bg-green-500');
                    this.classList.add('bg-green-600');
                }, 1000);

                // In a real app, you would add the item to the cart here
                console.log(`Added ${productName} to cart for ${productPrice}`);
            });
        });

        // Search functionality
        const searchInput = document.querySelector('.search-input');
        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            // In a real app, you would filter products based on search term
            console.log(`Searching for: ${searchTerm}`);
        });
    </script>
</body>
</html>
