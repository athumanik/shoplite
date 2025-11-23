<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Stocking</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        .modal-bg {
            background: rgba(0,0,0,0.4);
        }
        .fade-in {
            animation: fadeIn 0.3s ease-in-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to   { opacity: 1; }
        }
    </style>
</head>

<body class="bg-gray-100">

    <!-- HEADER -->
    <header class="bg-green-700 text-white p-4 shadow-md">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-xl font-bold flex items-center gap-2">
                <i class="fas fa-boxes"></i> Inventory Stocking
            </h1>
            <span id="current-date" class="opacity-80"></span>
        </div>
    </header>

    <div class="container mx-auto p-4 grid grid-cols-1 lg:grid-cols-4 gap-4">

        <!-- PRODUCT LIST -->
        <div class="lg:col-span-3">

            <!-- Search -->
            <div class="bg-white p-4 shadow rounded-xl mb-4">
                <div class="relative">
                    <i class="fas fa-search absolute left-4 top-3 text-gray-400"></i>
                    <input id="search-input" placeholder="Search products..."
                        class="w-full pl-10 p-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-green-500" />
                </div>
            </div>

            <!-- Products Grid -->
            <div id="product-list"
                class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-4">
            </div>

            <!-- Pagination -->
            <div class="flex justify-center mt-6 gap-3">
                <button id="prev-page"
                    class="px-4 py-2 bg-gray-200 rounded-lg hover:bg-gray-300">
                    <i class="fas fa-chevron-left"></i> Prev
                </button>
                <span id="page-number" class="font-semibold"></span>
                <button id="next-page"
                    class="px-4 py-2 bg-gray-200 rounded-lg hover:bg-gray-300">
                    Next <i class="fas fa-chevron-right"></i>
                </button>
            </div>

        </div>

        <!-- INVENTORY CART -->
        <div class="bg-white shadow-lg rounded-xl p-4 flex flex-col h-full">

            <h2 class="font-bold text-lg text-green-700 mb-2 flex items-center gap-2">
                <i class="fas fa-file-invoice"></i> Inventory Batch
                <span id="cart-count"
                    class="ml-auto bg-green-200 text-green-800 text-xs px-2 py-1 rounded-full">
                    0
                </span>
            </h2>

            <div id="cart-items" class="flex-grow max-h-[400px] overflow-y-auto pt-3"></div>
            <p id="empty-cart" class="text-gray-500 text-center py-10">
                No items added yet
            </p>

            <div class="border-t pt-4">
                <div class="flex justify-between text-lg font-bold text-green-700 mb-4">
                    <span>Total</span>
                    <span id="total-amount">0 Tsh</span>
                </div>

                <button id="checkout-btn"
                    class="w-full bg-green-700 text-white py-3 rounded-xl hover:bg-green-800">
                    <i class="fas fa-check-circle"></i> Complete Inventory
                </button>
            </div>
        </div>

    </div>

    <!-- INVENTORY MODAL -->
    <div id="checkout-modal"
        class="hidden fixed inset-0 modal-bg flex justify-center items-center p-4 z-50">

        <div class="bg-white w-full max-w-md p-6 rounded-2xl shadow-xl fade-in">

            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-bold text-green-700">
                    Finalize Inventory
                </h3>
                <button id="close-modal">
                    <i class="fas fa-times text-gray-500 text-xl"></i>
                </button>
            </div>

            <label class="block mb-4">
                <span class="text-sm">Supplier Name</span>
                <input id="customer"
                    class="w-full p-3 border rounded-xl focus:ring-2 focus:ring-green-500" />
            </label>

            <label class="block mb-4">
                <span class="text-sm">Notes (Optional)</span>
                <textarea id="notes" rows="2"
                    class="w-full p-3 border rounded-xl focus:ring-2 focus:ring-green-500"></textarea>
            </label>

            <label class="block mb-4">
                <span class="text-sm mb-2 block">Payment Method</span>
                <select id="payment-method"
                    class="w-full p-3 border rounded-xl">
                    <option value="Cash">Cash</option>
                    <option value="M-Pesa">M-Pesa</option>
                    <option value="Card">Card</option>
                </select>
            </label>

            <button id="confirm-checkout"
                class="w-full mt-4 bg-green-600 text-white py-3 rounded-xl hover:bg-green-700">
                Confirm Inventory
            </button>

        </div>

    </div>

    {{-- @include('stock.nav') --}}
    @include('stock.js')
</body>
</html>
