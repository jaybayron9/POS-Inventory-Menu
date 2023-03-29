<!-- Main modal -->
<div id="update-item-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
    <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
        <!-- Modal content -->
        <div class="relative p-4 bg-white rounded-lg shadow sm:p-5">
            <!-- Modal header -->
            <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 text-dark">
                    Update Item
                </h3>
                <button id="exit-modal" type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="update-item-modal">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <form id="update-item-form" action="#">
                <input type="hidden" name="id" id="upId">
                <div class="grid gap-4 mb-4 sm:grid-cols-2">
                    <div>
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 text-dark">Item Name</label>
                        <input type="text" name="upItemName" id="upItemName" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 bg-gray-100 dark:border-gray-600 dark:placeholder-gray-400 text-dark dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Chicken">
                    </div>
                    <div>
                        <label for="quantity" class="block mb-2 text-sm font-medium text-gray-900 text-dark">Quantity</label>
                        <input type="text" name="upQuantity" id="upQuantity" class="myInput bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 bg-gray-100 dark:border-gray-600 dark:placeholder-gray-400 text-dark dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="50 kg">
                    </div>
                    <div>
                        <label for="price" class="block mb-2 text-sm font-medium text-gray-900 text-dark">Unit Cost</label>
                        <input type="text" name="upUnitCost" id="upUnitCost" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 bg-gray-100 dark:border-gray-600 dark:placeholder-gray-400 text-dark dark:focus:ring-primary-500 dark:focus:border-primary-500 myInput" placeholder="225.00">
                    </div>
                    <div>
                        <label for="total price" class="block mb-2 text-sm font-medium text-gray-900 text-dark">Total Value</label>
                        <input type="text" name="upTotalValue" id="upTotalValue" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 bg-gray-100 dark:border-gray-600 dark:placeholder-gray-400 text-dark dark:focus:ring-primary-500 dark:focus:border-primary-500 myInput" placeholder="11,250.00">
                    </div>
                    <div>
                        <label for="location" class="block mb-2 text-sm font-medium text-gray-900 text-dark">Reorder Level</label>
                        <input type="text" name="reorderLevel" id="upReorderLevel" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 bg-gray-100 dark:border-gray-600 dark:placeholder-gray-400 text-dark dark:focus:ring-primary-500 dark:focus:border-primary-500 myInput" placeholder="50">
                    </div>
                    <div>
                        <label for="supplier" class="block mb-2 text-sm font-medium text-gray-900 text-dark">Supplier</label>
                        <input type="text" name="upSupplier" id="upSupplier" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 bg-gray-100 dark:border-gray-600 dark:placeholder-gray-400 text-dark dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="ABC Supplier">
                    </div>
                    <div>
                        <label for="location" class="block mb-2 text-sm font-medium text-gray-900 text-dark">Location</label>
                        <input type="text" name="upLocation" id="upLocation" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 bg-gray-100 dark:border-gray-600 dark:placeholder-gray-400 text-dark dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Freezer">
                    </div>
                    <div>
                        <label for="description" class="block mb-2 text-sm font-medium text-gray-900 text-dark">Description</label>
                        <textarea id="upDescription" name="description" rows="1" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 bg-gray-100 dark:border-gray-600 dark:placeholder-gray-400 text-dark dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Write item description here"></textarea>
                    </div>
                </div>
                <div class="flex">
                    <button type="submit" class="ml-auto text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                        Add
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#update-item-form').submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: 'index.php?i=update_item',
                type: 'POST',
                data: $(this).serialize(),
                dataType: 'json',
                success: function(data) {
                    if (data.status == 'success') {
                        location.reload();
                    } else {
                        alert(data.msg);
                    }
                }
            });
        });

        $('.myInput').on('keydown keyup', function(event) {
            var input = $(this);
            var value = input.val();

            value = value.replace(/[^0-9\.]/g, '');

            var decimalCount = (value.match(/\./g) || []).length;
            if (decimalCount > 1) {
                value = value.replace(/\.+$/, '');
            }

            input.val(value);
        });
    });
</script>