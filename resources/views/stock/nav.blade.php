<script>
    function productCard(p) {
    return `
    <div class="bg-white p-4 rounded-2xl shadow hover:shadow-md transition cursor-pointer">

        <div class="flex justify-between mb-3">
            <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center">
                <i class="fas fa-box text-green-600"></i>
            </div>
            <div class="text-right">
                <p class="text-xs text-gray-500">Current Stock</p>
                <p class="text-lg font-bold text-green-700">${p.stock}</p>
            </div>
        </div>

        <h3 class="font-semibold truncate mb-1">${p.name}</h3>
        <p class="text-sm text-gray-500">Buying: ${p.price} Tsh</p>

        <button class="mt-3 bg-green-600 text-white w-full py-2 rounded-xl add-btn"
            data-id="${p.id}">
            Add to Inventory
        </button>
    </div>
    `;
}


function cartItemRow(item){
    return `
    <div class="p-3 bg-gray-50 rounded-lg flex justify-between mb-2">
        <div>
            <p class="font-semibold">${item.name}</p>
            <p class="text-xs text-gray-500">SKU: ${item.sku}</p>
            <p class="text-xs">${item.qty} × ${item.unit} = <b>${item.total}</b></p>
        </div>

        <div class="flex flex-col gap-1">
            <button data-action="plus" data-id="${item.id}"
                class="bg-gray-200 px-2 rounded">+</button>
            <button data-action="minus" data-id="${item.id}"
                class="bg-gray-200 px-2 rounded">-</button>
            <button data-action="remove" data-id="${item.id}"
                class="bg-red-200 text-red-700 px-2 rounded">
                <i class="fas fa-trash"></i>
            </button>
        </div>
    </div>
    `;
}

</script>
