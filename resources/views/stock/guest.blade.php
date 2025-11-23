<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @include('stock.style')
</head>

<body class="bg-gray-50">
    <!-- Header -->
    <header class="bg-green-700 text-white p-4 shadow-md">
        <div class="container mx-auto flex justify-between items-center">
            <div class="flex items-center space-x-2">
                <i class="fas fa-leaf text-xl"></i>
                <h1 class="text-xl font-bold">Stocking</h1>
            </div>
            <div class="text-sm">
                <span id="current-date"></span>
            </div>
        </div>
    </header>

    {{-- notification --}}
    <div id="successToast"
        class="hidden fixed top-5 right-5 bg-green-600 text-white px-4 py-3 rounded-lg shadow-lg transition transform">
        Sale completed successfully ✅
    </div>

    <!-- Main Content -->
    <div class="container mx-auto p-4 flex flex-col lg:flex-row gap-4">
        <!-- Left Column - Products -->
        <div class="lg:w-3/4">
            <!-- Search and Filter -->
            <div class="bg-white rounded-lg shadow p-4 mb-4">
                <div class="flex flex-col md:flex-row gap-4">
                    <div class="flex-grow">
                        <div class="relative">
                            <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                            <input id="search-input"
                                class="w-full p-3 pl-10 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-green-500"
                                placeholder="Search products...">
                        </div>
                    </div>
                    <div class="flex gap-2 overflow-x-auto pb-2">

                        <!-- Pagination -->
                        <div class="flex justify-center mt-6">
                            <button id="prev-page"
                                class="px-4 py-2 bg-gray-200 rounded-l-lg hover:bg-gray-300 disabled:opacity-50 disabled:cursor-not-allowed transition-colors">
                                <i class="fas fa-chevron-left"></i> Prev
                            </button>
                            <span id="page-number"
                                class="px-4 py-2 font-semibold bg-white border-t border-b border-gray-300"></span>
                            <button id="next-page"
                                class="px-4 py-2 bg-gray-200 rounded-r-lg hover:bg-gray-300 disabled:opacity-50 disabled:cursor-not-allowed transition-colors">
                                Next <i class="fas fa-chevron-right"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Product List -->
            <div id="product-list" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4">
                <!-- Products will be rendered here -->
            </div>


        </div>

        <!-- Right Column - Cart -->
        <div class="lg:w-1/4 mt-4 lg:mt-0">
            <div class="bg-white rounded-lg shadow-lg h-full flex flex-col">
                <!-- Cart Header -->
                <div class="bg-green-600 text-white p-4 rounded-t-lg">
                    <h2 class="font-bold text-lg flex items-center">
                        <i class="fas fa-shopping-cart mr-2"></i>
                        Stocking Cart
                        <span id="cart-count" class="ml-2 bg-green-800 text-xs px-2 py-1 rounded-full">0</span>
                    </h2>
                </div>

                <!-- Cart Items -->
                <div class="p-4 flex-grow overflow-y-auto max-h-96">
                    <div id="cart-items"></div>
                    <p id="empty-cart" class="text-gray-500 text-center py-8">
                        <i class="fas fa-shopping-cart text-4xl mb-2 block"></i>
                        Your cart is empty
                    </p>
                </div>

                <!-- Cart Footer -->
                <div class="p-4 border-t">
                    <div class="flex justify-between items-center mb-4">
                        <span class="font-semibold">Total:</span>
                        <span id="total-amount" class="font-bold text-xl text-green-700">0 Tsh</span>
                    </div>

                    <div class="grid grid-cols-2 gap-2">
                        <button id="cancel-btn"
                            class="px-3 py-3 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition-colors btn-hover">
                            <i class="fas fa-times mr-1"></i> Cancel
                        </button>
                        <button id="hold-btn"
                            class="px-3 py-3 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 transition-colors btn-hover">
                            <i class="fas fa-pause mr-1"></i> Hold
                        </button>
                    </div>
                    <button id="checkout-btn"
                        class="w-full mt-2 px-3 py-3 bg-green-700 text-white rounded-lg hover:bg-green-800 transition-colors btn-hover">
                        <i class="fas fa-credit-card mr-1"></i> Checkout
                    </button>
                </div>
            </div>
        </div>
    </div>




    <!-- Checkout Modal -->
    <div id="checkout-modal" class="hidden fixed inset-0 modal-bg flex items-center justify-center z-50 fade-in">
        <div class="bg-white p-6 rounded-xl shadow-2xl w-96 max-w-full mx-4">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-bold text-green-700">Confirm Checkout</h3>
                <button id="close-modal" class="text-gray-500 hover:text-gray-700">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            <div class="p-4 rounded-lg mb-4">
                <input type="text" for="supplier" id="supplier" name="name" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                    placeholder="Supplier Name">
            </div>
            <div class="bg-green-50 p-4 rounded-lg mb-4">
                <p class="text-sm text-gray-600 mb-1">Total Amount:</p>
                <p class="text-2xl font-bold text-green-700" id="checkout-total">0 Tsh</p>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Payment Method</label>
                <div class="flex gap-2 overflow-x-auto pb-2">
                    <button
                        class="payment-option px-4 py-2 bg-green-100 text-green-800 rounded-lg whitespace-nowrap border-2 border-green-500">
                        <i class="fas fa-money-bill-wave mr-1"></i> Cash
                    </button>
                    <button
                        class="payment-option px-4 py-2 bg-gray-100 text-gray-800 rounded-lg whitespace-nowrap border border-gray-300">
                        <i class="fas fa-mobile-alt mr-1"></i> M-Pesa
                    </button>
                    <button
                        class="payment-option px-4 py-2 bg-gray-100 text-gray-800 rounded-lg whitespace-nowrap border border-gray-300">
                        <i class="fas fa-credit-card mr-1"></i> Card
                    </button>
                </div>
                <select id="payment-method" class="hidden w-full border p-2 rounded-lg mt-2">
                    <option value="cash">Cash</option>
                    <option value="mpesa">M-Pesa</option>
                    <option value="card">Card</option>
                </select>
            </div>

            <div class="flex justify-end gap-2 mt-4">
                <button id="close-modal-btn"
                    class="px-4 py-2 bg-gray-400 text-white rounded-lg hover:bg-gray-500 transition-colors">
                    Cancel
                </button>
                <button id="confirm-checkout"
                    class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
                    Confirm Payment
                </button>
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

        //     function productCard(p) {
        //         return `
    //     <div class="product-card bg-white rounded-xl shadow p-4 hover:shadow-md transition-shadow fade-in">
    //     <div class="h-32 bg-green-50 rounded-lg mb-3 flex items-center justify-center">
    //         <i class="fas fa-seedling text-4xl text-green-600"></i>
    //     </div>
    //     <h3 class="font-semibold text-sm mb-1 truncate">${p.name}</h3>
    //     <p class="text-green-700 font-bold text-lg mb-3">${p.price.toLocaleString()} Tsh</p>
    //     <button class="add-btn bg-green-600 text-white w-full py-2 rounded-lg hover:bg-green-700 transition-colors btn-hover"
    //         data-id="${p.id}">
    //         <i class="fas fa-cart-plus mr-1"></i> Add Stock
    //     </button>
    // </div>
    // `;
        //     }

        function formatPrice(price) {
            return Number(price).toLocaleString("en-US");
        }

        function formatName(name) {
            return name
                .toLowerCase()
                .split(" ")
                .map(word => word.charAt(0).toUpperCase() + word.slice(1))
                .join(" ");
        }

        function truncate(text, max = 30) {
            if (!text) return "No name";
            return text.length > max ? text.substring(0, max) + "..." : text;
        }

        function productCard(p) {
            let stockColor = "text-green-600";
            let btnColor = "bg-green-600 hover:bg-green-700";

            if (p.stock === 0) {
                stockColor = "text-red-600 font-bold";
                btnColor = "bg-red-600 hover:bg-red-700";
            } else if (p.stock <= 5) {
                stockColor = "text-yellow-600 font-semibold";
                btnColor = "bg-yellow-600 hover:bg-yellow-700";
            }

            return `
    <div class="product-card bg-white rounded-2xl shadow p-4 hover:shadow-md transition-all fade-in">

        <!-- TOP ROW: ICON + STOCK -->
        <div class="flex items-center mb-3">
            <!-- Icon -->
            <div class="w-12 h-12 rounded-xl bg-green-100 flex items-center justify-center mr-3">
                <i class="fas fa-box text-green-600 text-xl"></i>
            </div>

            <!-- Stock -->
            <div class="flex-1 text-right">
                <span class="text-xs text-gray-500">Stock</span>
                <p class="text-lg ${stockColor}">${p.stock}</p>
            </div>
        </div>

        <!-- Name -->

        <h3 class="font-medium text-sm text-gray-800 truncate mb-1" title="${formatName(p.name)}">
            ${formatName(p.name)}
        </h3>

        <!-- Price -->
        <p class="text-gray-900 font-bold text-md mb-3">
           ${formatPrice(p.price)}
        </p>

        <!-- Add Stock Button -->
        <button
            class="${btnColor} text-white w-full py-2 rounded-xl transition-colors add-btn"
            data-id="${p.id}"
        >
            <i class="fas fa-plus mr-1"></i>
            Add Stock
        </button>
    </div>
    `;
        }



        function cartItemRow(item) {
            const nameFormatted = formatName(item.name);
            const nameShort = truncate(nameFormatted, 18);
            return `
        <div class="cart-row flex justify-between items-center my-3 bg-gray-50 p-3 rounded-lg fade-in">
            <div class="flex-grow">
            <p class="font-medium text-sm truncate" title="${nameFormatted}">
                ${nameShort}
            </p>
             <p class="text-xs text-gray-500">
               ${formatPrice(item.price)} × ${item.qty} = ${formatPrice(item.price * item.qty)}
            </p>
            </div>
            <div class="flex gap-1">
                <button data-action="minus" data-id="${item.id}"
                    class="px-2 py-1 bg-gray-200 rounded hover:bg-gray-300 transition-colors">-</button>
                <span class="px-2 py-1 text-sm">${item.qty}</span>
                <button data-action="plus" data-id="${item.id}"
                    class="px-2 py-1 bg-gray-200 rounded hover:bg-gray-300 transition-colors">+</button>
                <button data-action="remove" data-id="${item.id}"
                    class="px-2 py-1 bg-red-100 text-red-600 rounded hover:bg-red-200 transition-colors">
                    <i class="fas fa-trash"></i>
                </button>
            </div>
        </div>
        `;
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @include('stock.script')
</body>

</html>
