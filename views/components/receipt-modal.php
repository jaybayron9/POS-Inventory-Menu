<div id="receipt-modal" data-modal-backdrop="static" tabindex="-1" aria-hidden="false" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
    <div class="relative w-full max-w-md h-full md:h-auto ">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow">
            <!-- Modal header -->
            <div class="flex items-start justify-between px-4 pt-4 rounded-t">
                <h3 class="text-xl font-semibold text-gray-900">
                    Order Receipt
                </h3>
                <button id="x-button" type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-hide="receipt-modal">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>
            <!-- Modal body -->
            <div class="px-6 pb-5 pt-1 space-y-6">
                <input type="hidden" id="order_id">

                <div class="mb-2 flex">
                    <p>Total : <span class="text-green-500">₱</span> <span id="total"></span></p>
                    <p id="discoutotal" class="ml-auto hidden">Total Discount : <span class="text-green-500">₱</span> <span id="finaltotal"></span></p>
                </div>

                <div class="flex items-center justify-center gap-3">
                    <div>
                        <label for="Payment amount" class="font-semibold text-xs">PAYMENT</label>
                        <input type="text" id="payment-amount" name="payment_amount" title="Payment amount" data-row-data="1" placeholder="0" maxlength="11" class="payment w-full rounded-l-md border-gray-400 shadow-md text-green-700 myInput placeholder:text-green-500 py-1" list="paymenttList">
                        <datalist id="paymenttList">
                            <option id="op-pay" value="">
                        </datalist>
                    </div>

                    <div data-drawer-hide="drawer-backdrop" aria-controls="drawer-backdrop">
                        <label for="Change" class="font-semibold text-xs">CHANGE</label>
                        <input type="number" id="change" name="change" disabled title="Change" placeholder="0" class="w-full px-2 rounded-r-md border-gray-300 bg-gray-100 shadow-md text-red-500 placeholder:text-red-500 py-1">
                    </div>

                    <div>
                        <label for="Discount" class="font-semibold text-xs">%&nbsp;DISCOUNT</label>
                        <input type="text" id="discount" name="discount" title="Discount" placeholder="0" maxlength="5" class="discount w-full rounded-l-md border-gray-400 shadow-md text-green-700 myInput placeholder:text-green-500 py-1" list="discountList">
                        <datalist id="discountList">
                            <?php for ($i=1; $i <= 99; $i++) { ?>
                            <option value="<?= $i ?>">
                            <?php } ?>
                        </datalist>
                    </div>

                    <div>
                        <label for="Discounted amount" class="font-semibold text-xs">DISCOUNTED</label>
                        <input type="number" id="discountamount" name="discountamount" disabled title="Discount amount" placeholder="0" class="w-full rounded-r-md border-gray-300 bg-gray-100 shadow-md text-red-500 placeholder:text-red-500 py-1">
                    </div>
                </div>
                <button id="print-receipt" title="print receipt" class="ml-auto whitespace-nowrap border rounded-md border-gray-500 hover:border-gray-50 rounded-md mt-5 flex px-4 py-1 bg-gradient-to-r from-red-500 to-gray-700 text-white hover:text-red-200">
                    PRINT RECEIPT
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#print-receipt').click(function(e) {
            e.preventDefault();
            var payment = $('#payment-amount').val();

            if(payment == '' || payment == 0) {
                return swal({
                    title: "Payment amount is required",
                    icon: "warning",
                    button: "OK",
                })
            }
            
            $.ajax({
                url: 'index.php?h=receipt',
                type: 'POST',
                data: {
                    order_id: $('#order_id').val(),
                    total: $('#total').html(),
                    payment_amount: $('#payment-amount').val(),
                    change: $('#change').val(),
                    discount: $('#discount').val(),
                    discount_amount: $('#discountamount').val(),
                },
                success: function(resp) {
                    var iframe = "<iframe src='receipt.php' style='display: none;' ></iframe>";
                    $("body").append(iframe);
                    var iframeElement = document.querySelector("iframe");
                    iframeElement.contentWindow.print();
                }
            });
        });

        $('#change').val('0.00');
        $('#discountamount').val('0.00');
        $('#payment-amount').on('input', function() {
            change();
        });

        // event listener to discount field
        $('#discount').on('input', function() {
            if ($(this).val() > 0) {
                $('#discoutotal').removeClass('hidden');
            } else {
                $('#discount').val(0);
                $('#discoutotal').addClass('hidden');
            }

            if (parseFloat($("#discount").val()) >= 100) {
                swal({
                    title: "Error!",
                    text: "Discount must be below than 100",
                    icon: "error",
                    button: "Ok",
                })
            }

            discounted();
            updateTotal();
        });

        $('#discount').on('focus', function() {
            if ($(this).val() == '0') {
                $(this).val('');
            }
        }).on('blur', function() {
            if ($(this).val() == '') {
                $(this).val('0');
            }
        });

        // validation for number field
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


        function discounted() {
            var total = parseFloat($('#total').html());
            var discount = parseFloat($('#discount').val());
            var payment = parseFloat($('#payment-amount').val());

            var discountAmount = total * (discount / 100);
            var NewTotal = total - discountAmount;
            var NewChange = payment - NewTotal;

            $('#discountamount').val(discountAmount.toFixed(2));
            $('#finaltotal').html(NewTotal.toFixed(2));
            $('#change').val(NewChange.toFixed(2));
        }

        // change
        function change() {
            if ($('#finaltotal').html() == '') {
                $('#change').val(parseFloat($('#payment-amount').val()).toFixed(2) - parseFloat($('#total').html()).toFixed(2));
            } else {
                $('#change').val(parseFloat($('#payment-amount').val()).toFixed(2) - parseFloat($('#finaltotal').html()).toFixed(2));
            }
        }

        $(document).keydown(function(event) {
            if (event.which == 27) {
                // Your code to handle the escape key event goes here
                window.location.reload(true);
            }
        });

        $('#x-button').click(function() {
            window.location.reload(true);
        });
    })
</script>