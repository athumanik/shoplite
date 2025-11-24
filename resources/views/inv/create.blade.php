  <!-- Create/Edit Inventory Form -->
  <div id="form-view" class="hidden p-6">
      <div class="max-w-6xl mx-auto">
          <div class="form-card bg-white rounded-lg border border-gray-200 fade-in">
              <!-- Form Header -->
              <div class="px-6 py-4 border-b border-gray-200">
                  <div class="flex items-center justify-between">
                      <h3 class="text-lg font-medium text-gray-900" id="form-title">New Inventory
                          Purchase</h3>
                      <button class="text-gray-400 hover:text-gray-600" id="back-to-list">
                          <i class="fas fa-times"></i>
                      </button>
                  </div>
              </div>

              <!-- Form Content -->
              <div class="p-6">
                  <form id="inventory-form">
                      <!-- Supplier & Payment Info -->
                      <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                          <div>
                              <label for="supplier" class="block text-sm font-medium text-gray-700 mb-2">Supplier
                                  *</label>
                              <input type="text" id="supplier" name="supplier" required
                                  class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                                  placeholder="Enter supplier name" value="WholeSaler">
                          </div>
                          <div>
                              <label for="payment_method" class="block text-sm font-medium text-gray-700 mb-2">Payment
                                  Method
                                  *</label>
                              <select id="payment_method" name="payment_method" required
                                  class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                                  <option value="Cash">Cash</option>
                                  <option value="Bank Transfer">Bank Transfer</option>
                                  <option value="Cheque">Cheque</option>
                                  <option value="Credit">Supplier Credit</option>
                              </select>
                          </div>
                      </div>

                      <!-- Purchase Items -->
                      <div class="mb-6">
                          <div class="flex items-center justify-between mb-4">
                              <label class="block text-sm font-medium text-gray-700">Purchase
                                  Items</label>
                              <button type="button" id="add-item-btn"
                                  class="px-3 py-1 bg-green-600 text-white rounded text-sm hover:bg-green-700">
                                  <i class="fas fa-plus mr-1"></i>Add Item
                              </button>
                          </div>

                          <div class="border border-gray-200 rounded-lg overflow-hidden">
                              <table class="w-full">
                                  <thead class="bg-gray-50">
                                      <tr>
                                          <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                              Product</th>
                                          <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                              Quantity</th>
                                          <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                              Unit Price</th>
                                          <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                              Total</th>
                                          <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                              Actions</th>
                                      </tr>
                                  </thead>
                                  <tbody id="inventory-items-container" class="divide-y divide-gray-200">
                                      <!-- Inventory items will be added here -->
                                  </tbody>
                                  <tfoot class="bg-gray-50">
                                      <tr>
                                          <td colspan="4"
                                              class="px-4 py-3 text-right text-sm font-medium text-gray-700">
                                              Subtotal</td>
                                          <td class="px-4 py-3 text-sm font-medium text-gray-900" id="subtotal-display">
                                              0</td>
                                          <td></td>
                                      </tr>
                                      <tr>
                                          <td colspan="4"
                                              class="px-4 py-3 text-right text-sm font-medium text-gray-700">
                                              Tax (if any)</td>
                                          <td class="px-4 py-3 text-sm font-medium text-gray-900" id="tax-display">0
                                          </td>
                                          <td></td>
                                      </tr>
                                      <tr>
                                          <td colspan="4"
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

                      <!-- Additional Information -->
                      <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                          <div>
                              <label for="receipt" class="block text-sm font-medium text-gray-700 mb-2">Receipt
                                  Number</label>
                              <input type="text" id="receipt" name="receipt"
                                  class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                                  placeholder="Enter receipt number">
                          </div>
                          <div>
                              <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                              <select id="status" name="status"
                                  class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                                  <option value="paid">Paid</option>
                                  <option value="pending">Pending</option>
                                  <option value="cancelled">Cancelled</option>
                              </select>
                          </div>
                      </div>

                      <!-- Notes -->
                      <div class="mb-6">
                          <label for="notes" class="block text-sm font-medium text-gray-700 mb-2">Notes</label>
                          <textarea id="notes" name="notes" rows="3"
                              class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                              placeholder="Add any notes about this purchase..."></textarea>
                      </div>

                      <!-- Form Actions -->
                      <div class="flex items-center justify-end space-x-3 pt-6 border-t border-gray-200">
                          <button type="button" id="cancel-form"
                              class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
                              Cancel
                          </button>
                          <button type="submit"
                              class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                              Save Purchase
                          </button>
                      </div>
                  </form>
              </div>
          </div>
      </div>
  </div>
