<div id="in-modal" data-modal-backdrop="static" tabindex="-1" aria-hidden="false" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
    <div class="relative w-full max-w-md h-full md:h-auto ">
        <!-- Modal content -->
        <div class="relative bg-white rounded shadow">
            <!-- Modal header -->
            <div class="flex items-start justify-between px-4 pt-4 rounded-t">
                <h3 class="text-xl font-semibold text-gray-900">
                    IN STOCK
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-hide="in-modal">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>
            <!-- Modal body -->
            <div class="px-6 pb-5">
                <form id="in-form" class="flex items-center justify-center gap-3">
                    <input type="hidden" id="in_product_id" name="product_id">
                    <input type="text" id="in" name="in" title="in" data-row-data="1" maxlength="5" class="payment w-full rounded border-gray-400 shadow-md text-green-700 myInput py-1 mt-5 text-center">
                    <button type="submit" class="ml-auto whitespace-nowrap border rounded-md border-gray-500 hover:border-gray-50 rounded-md mt-5 flex px-4 py-1 bg-gradient-to-r from-red-500 to-gray-700 text-white hover:text-red-200">
                        IN
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(function() {
        $('#in-form').submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: 'index.php?a=in_out',
                type: 'POST',
                data: $(this).serialize(),
                dataType: 'json',
                success: function(resp) {
                    if (resp.status == 'success') {
                        swal({
                            title: 'Success',
                            text: resp.msg,
                            icon: 'success',
                            button: false,
                            timer: 2000
                        }).then(() =>{ location.reload() });
                    } else {
                        swal({
                            title: 'Error',
                            text: resp.msg,
                            icon: 'error',
                            button: false,
                            timer: 2000
                        });
                    }
                }
            });
        });
    });
</script>