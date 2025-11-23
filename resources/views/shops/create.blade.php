     <!-- Create/Edit Sale Form -->
     {{-- <div id="form-view" class="hidden p-6"> --}}
     <div id="form-view" class="p-6">
         <div class="max-w-4xl mx-auto">
             <div class="form-card bg-white rounded-lg border border-gray-200">
                 <!-- Form Header -->
                 <div class="px-6 py-4 border-b border-gray-200">
                     <div class="flex items-center justify-between">
                         <h3 class="text-lg font-medium text-gray-900" id="form-title">Create New Sale</h3>
                         <button class="text-gray-400 hover:text-gray-600" id="back-to-list">
                             <i class="fas fa-times"></i>
                         </button>
                     </div>
                 </div>

                 <!-- Form Content -->
                 <div class="p-6">
                     <form id="sale-form">
                         <!-- Customer & Payment Info -->
                         <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                             <div>
                                 <label for="customer"
                                     class="block text-sm font-medium text-gray-700 mb-2">Customer</label>
                                 <input type="text" id="customer" name="customer"
                                     class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                                     placeholder="Enter customer name" value="Regular">
                             </div>
                             <div>
                                 <label for="payment_method"
                                     class="block text-sm font-medium text-gray-700 mb-2">Payment
                                     Method</label>
                                 <select id="payment_method" name="payment_method"
                                     class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                                     <option value="cash">Cash</option>
                                     <option value="card">Card</option>
                                     <option value="mobile">Mobile Money</option>
                                     <option value="credit">Farmer Credit</option>
                                 </select>
                             </div>
                         </div>

                         <!-- Sale Items -->
                         <div class="mb-6">
                             <div class="flex items-center justify-between mb-4">
                                 <label class="block text-sm font-medium text-gray-700">Sale Items</label>
                                 <button type="button" id="add-item-btn"
                                     class="px-3 py-1 bg-green-600 text-white rounded text-sm hover:bg-green-700">
                                     <i class="fas fa-plus mr-1"></i>Add Item
                                 </button>
                             </div>

                             <div class="border border-gray-200 rounded-lg overflow-hidden">
                                 <table class="w-full">
                                     <thead class="bg-gray-50">
                                         <tr>
                                             <th
                                                 class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                                 Product</th>
                                             <th
                                                 class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                                 Quantity</th>
                                             <th
                                                 class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                                 Unit Price</th>
                                             <th
                                                 class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                                 Total</th>
                                             <th
                                                 class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                                 Actions</th>
                                         </tr>
                                     </thead>
                                     <tbody id="sale-items-container" class="divide-y divide-gray-200">
                                         <!-- Sale items will be added here -->
                                     </tbody>
                                     <tfoot class="bg-gray-50">
                                         <tr>
                                             <td colspan="3"
                                                 class="px-4 py-3 text-right text-sm font-medium text-gray-700">
                                                 Subtotal</td>
                                             <td class="px-4 py-3 text-sm font-medium text-gray-900"
                                                 id="subtotal-display">0</td>
                                             <td></td>
                                         </tr>
                                         <tr>
                                             <td colspan="3"
                                                 class="px-4 py-3 text-right text-sm font-medium text-gray-700">
                                                 Tax (0%)</td>
                                             <td class="px-4 py-3 text-sm font-medium text-gray-900" id="tax-display">0
                                             </td>
                                             <td></td>
                                         </tr>
                                         <tr>
                                             <td colspan="3"
                                                 class="px-4 py-3 text-right text-sm font-medium text-gray-700">
                                                 Grand Total</td>
                                             <td class="px-4 py-3 text-lg font-bold text-green-600"
                                                 id="grand-total-display">0</td>
                                             <td></td>
                                         </tr>
                                     </tfoot>
                                 </table>
                             </div>
                         </div>

                         <!-- Notes -->
                         <div class="mb-6">
                             <label for="notes" class="block text-sm font-medium text-gray-700 mb-2">Notes</label>
                             <textarea id="notes" name="notes" rows="3"
                                 class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                                 placeholder="Add any notes about this sale..."></textarea>
                         </div>

                         <!-- Form Actions -->
                         <div class="flex items-center justify-end space-x-3 pt-6 border-t border-gray-200">
                             <button type="button" id="cancel-form"
                                 class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
                                 Cancel
                             </button>
                             <button type="button" id="hold-form"
                                 class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
                                 Hold Sales
                             </button>
                             <button type="submit"
                                 class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                                 Create Sales
                             </button>
                         </div>
                     </form>
                 </div>
                 <!-- Form Content -->


             </div>
         </div>
     </div>

     <!-- Create/Edit Sale Form -->
