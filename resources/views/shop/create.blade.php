<div id="form-view" class="hidden p-6">
    <div class="max-w-2xl mx-auto">
        <div class="form-card bg-white rounded-lg border border-gray-200 fade-in">
            <!-- Form Header -->
            <div class="px-6 py-4 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-medium text-gray-900" id="form-title">New Product</h3>
                    <button class="text-gray-400 hover:text-gray-600" id="back-to-list">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>

            <!-- Form Content -->
            <div class="p-6">
                <form id="product-form">
                    <!-- Basic Information -->
                    <div class="space-y-6">

                        <div class="grid grid-cols-2 md:grid-cols-2 gap-4">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Product Name
                                    *</label>
                                <input type="text" id="name" name="name" required
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                                    placeholder="Enter product name">
                            </div>
                            <div>
                                <label for="price" class="block text-sm font-medium text-gray-700 mb-2">Price
                                    *</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        {{-- <span class="text-gray-500 mr-2">Tsh</span> --}}
                                    </div>
                                    <input type="number" id="price" name="price" required step="1000"
                                        min="0"
                                        class="w-full pl-7 pr-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                                        placeholder="0">
                                </div>
                            </div>

                        </div>

                        <div class="grid grid-cols-2 md:grid-cols-2 gap-4">

                            <div>
                                <label for="wholesale_price"
                                    class="block text-sm font-medium text-gray-700 mb-2">Wholesale Price *</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                         {{-- <span class="text-gray-500 mr-2">Tsh</span> --}}

                                    </div>
                                    <input type="number" id="wholesale_price" name="wholesale_price" required
                                        step="1000" min="0"
                                        class="w-full pl-7 pr-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                                        placeholder="0">
                                </div>
                            </div>

                            <div>
                                <label for="buying_price" class="block text-sm font-medium text-gray-700 mb-2">Buying
                                    Price</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        {{-- <span class="text-gray-500 mr-2">Tsh</span> --}}
                                    </div>
                                    <input type="number" id="buying_price" name="buying_price" step="1000"
                                        min="0"
                                        class="w-full pl-7 pr-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                                        placeholder="0">
                                </div>
                            </div>
                        </div>


                    </div>
                    <!-- Form Actions -->
                    <div class="flex items-center justify-end space-x-3 pt-6 border-t border-gray-200">

                        <button type="button" id="cancel-form"
                            class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
                            Cancel
                        </button>

                         {{-- <button type="submit" id="create-product-btn" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                            Create Another Product
                        </button> --}}

                        <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                           Create Product
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
