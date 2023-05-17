$(document).ready(function () {
    // Search
    let noResultsAdded = false;

    $('.search').on('keyup input', function () {
        const searchValue = $(this).val().toLowerCase();
        const listItems = $('.meal-list .meal');

        let visibleItems = 0;
        listItems.each(function () {
            const userName = $(this).text().toLowerCase();

            if (userName.indexOf(searchValue) > -1) {
                $(this).css('display', 'block');
                visibleItems++;
            } else {
                $(this).css('display', 'none');
            }
        });

        if (visibleItems === 0 && !noResultsAdded) {
            $('.meal-list').append('<li class="no-results font-medium text-gray-400 text-center mt-32 mb-32">No results</li>');
            noResultsAdded = true;
        } else if (visibleItems > 0 && noResultsAdded) {
            $('.no-results').remove();
            noResultsAdded = false;
        }
    });

    // Tabs
    $('#nav-drinks').click(function () {
        $('#drinks-menu').fadeIn();
        $('#meals-menu').hide();
        $('#add-ons-menu').hide();
    });

    $('#nav-meals').click(function () {
        $('#meals-menu').fadeIn();
        $('#drinks-menu').hide();
        $('#add-ons-menu').hide();
    })

    $('#nav-add-ons').click(function () {
        $('#add-ons-menu').fadeIn();
        $('#meals-menu').hide();
        $('#drinks-menu').hide();
    })

    //Keypad 
    $(".key").click(function () {
        var value = $(this).text();
        var paymentAmount = $("#payment-amount");
        var numberValue = $('#number-value');
        paymentAmount.val(paymentAmount.val() + value);
        numberValue.text(numberValue.text() + value);
        discounted();
        updateTotal();
    });

    $("#backspace").click(function () {
        var paymentAmount = $("#payment-amount");
        var numberValue = $('#number-value');
        paymentAmount.val(paymentAmount.val().slice(0, -1));
        numberValue.text(numberValue.text().slice(0, -1));
        discounted();
        updateTotal();
    });

    // Note
    // adjust the height of the textarea based on the scrollHeight
    $('#note').on('input', function () {
        $(this).height(0);
        $(this).height(this.scrollHeight);
    });

    // Receipt Record
    // Add to the receipt table
    $('.add-button').click(function () {
        var str = $(this).data('row-data');
        var values = str.split(',');

        var id = values[0];
        var name = values[1];
        var price = parseFloat(values[2]);
        var exist = false;
        var $quantityCell, $priceCell;
        var quantity = 1;

        $('tbody tr td:first-child').each(function () {
            if ($(this).text() === name) {
                exist = true;
                $quantityCell = $(this).closest('tr').find('td:nth-child(3)');
                $priceCell = $(this).closest('tr').find('td:nth-child(2)');
                return false;
            }
        });

        if (isNaN(price)) {
            swal({
                icon: 'warning',
                title: "Invalid price value",
                confirmationbutton: true,
                dangerMode: true,
            });
            return;
        }
        if (exist) {
            var quantity = parseFloat($quantityCell.text()) + 1;
            var total_price = parseFloat($priceCell.text()) + price;
            $quantityCell.text(quantity);
            $('tr.product-row').removeClass('bg-gray-200'); 
            $quantityCell.closest('.product-row').addClass('bg-gray-200'); 
            $priceCell.text(total_price);
        } else {
            var row = '<tr class="text-center order-rows hover:bg-green-100 border-b border-gray-200 product-row">';
                    row += '<td class="text-left text-gray-900 pl-2 py-2 text-l font-medium capitalize">' + name + '</td>';
                    row += '<td class="text-gray-900">' + price + '</td>';
                    row += '<td class="text-gray-900 quantity-cell">1</td>'; 
                    row += '<td class="delcol text-gray-900"><button class="delete-button"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mt-1 text-red-500"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg></button></td>';
                row += '</tr>';

            $('tbody').append(row);
            var tableScrollBar = $('#table-scrollbar');
            tableScrollBar.scrollTop(tableScrollBar[0].scrollHeight);
            $('tr.product-row').removeClass('bg-gray-200'); 
            $('tr.product-row:first-child').addClass('bg-gray-200'); 
        }

        updateTotal();
        discounted();
        change();

        $.ajax({
            url: 'index.php?a=availability',
            type: 'POST',
            data: {
                p_id: id,
                p_quantity: quantity
            },
            success: function(resp) {
                if (resp == 'true') {
                    swal({
                        icon: 'warning',
                        title: "The requested quantity exceeds the available stock of the product.",
                        confirmationbutton: true,
                        dangerMode: true,
                    });
                }
            }   
        });
    });

    // Subtract the added item quantity
    $('.sub-button').click(function () {
        var str = $(this).data('row-data');
        var values = str.split(',');
        var id = values[0];
        var name = values[1];
        var price = parseFloat(values[2]);
        var exist = false;
        var $quantityCell, $priceCell, $row;

        $('tbody tr td:first-child').each(function () {
            if ($(this).text() === name) {
                exist = true;
                $row = $(this).closest('tr');
                $quantityCell = $row.find('td:nth-child(3)');
                $priceCell = $row.find('td:nth-child(2)');
                return false;
            }
        });

        if (isNaN(price)) {
            console.log("Invalid price value");
            return;
        }

        if (exist) {
            var quantity = parseFloat($quantityCell.text()) - 1;
            var total_price = parseFloat($priceCell.text()) - price;

            if (quantity < 1) {
                $row.remove();
            } else {
                $quantityCell.text(quantity);
                $priceCell.text(total_price);
            }
        }

        updateTotal();
        discounted();
        change();
    });

    // Remove order row
    $(document).on('click', '.delete-button', function () {
        $(this).closest('tr').remove();
        updateTotal();
        discounted();
    });

    // Refresh button
    $("#refresh-table").click(function () {
        $(this).addClass('animate-spin');

        $.ajax({
            url: 'index.php?refresh_table',
            success: function(){
                setTimeout(function () {
                    $("#refresh-table").removeClass('animate-spin');
                    location.reload();
                }, 500);
            }
        });
    });

    function updateTotal() {
        var total = 0;
        var $tbody = $('tbody');
        $('tbody tr td:nth-child(2)').each(function () {
            total += parseFloat($(this).text());
        });
        if (total == 0) {
            if ($tbody.find('tr').length == 0) {
                $tbody.append('<tr><td colspan="4" class="text-center py-40">No Orders Made</td></tr>');
            }
        } else {
            $tbody.find('tr:contains("No Orders Made")').remove();
        }

        $('#op-subtotal').val(total);
        $('#total').text(total);
    }
    updateTotal();

    // discounted
    function discounted(){
        var total = parseFloat($('#total').html());
        var discount = parseFloat($('#discount').val());
        var payment = parseFloat($('#payment-amount').val());

        var discountAmount = total * (discount / 100);
        var NewTotal = total - discountAmount;
        var NewChange = payment - NewTotal;

        $('#discountamount').val(discountAmount.toFixed(2));
        $('#finaltotal').html(NewTotal.toFixed(2));
        $('#change').val(NewChange.toFixed(2));
        $('#op-totaldue').val(NewTotal);
    }
    
    // change
    function change(){
        if($('#finaltotal').html() == '' ) {
            $('#change').val(parseFloat($('#payment-amount').val()).toFixed(2) - parseFloat($('#total').html()).toFixed(2));
        } else {
            $('#change').val(parseFloat($('#payment-amount').val()).toFixed(2) - parseFloat($('#finaltotal').html()).toFixed(2));
        }
    }

    // event listener to payment field
    $('#payment-amount').on('input', function () {
        change();
    });
    
    // event listener to discount field
    $('#discount').on('input', function () {
        if ($(this).val() > 0) {
            $('.discounttotal').removeClass('hidden');
        } else {
            $('#discount').val(0);
            $('.discounttotal').addClass('hidden');
        }

        if (parseFloat($("#discount").val()) >= 100) {
            $('#error-alert-div').removeClass('hidden');
            $('#error-alert-msg').text('Discount must be below than 100')
        } else {
            $('#error-alert-div').addClass('hidden');
        }

        discounted();
        updateTotal();
    });

    $('#discount').val(0);

    $('#discount').on('focus', function () {
        if ($(this).val() == '0') {
            $(this).val('');
        }
    }).on('blur', function () {
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

    setTimeout(function () {
        $("#success-alert").slideUp();
        $.ajax({
            url: 'index.php?a=unset'
        })
    }, 2000);

    $('#print-receipt').click(function () {
        if (($('tbody tr').length === 1 && $('tbody tr').text() === "No Orders Made")) {
            swal({
                icon: "warning",
                text: "No Orders Made",
                confirmationbutton: true,
            });
        } else if ($('#customer').val() == ''){
            swal({
                icon: "warning",
                text: "Please provide table no. or customer name.",
                confirmationbutton: true,
            });
        } else {
            var data = [];
            $('tbody tr').each(function () {
                var name = $(this).find('td:first-child').text();
                var price = $(this).find('td:nth-child(2)').text();
                var quantity = $(this).find('td:nth-child(3)').text();
                data.push({
                    name: name,
                    price: price,
                    quantity: quantity
                });
            });

            $.ajax({
                type: "POST",
                url: "index.php?a=print",
                data: {
                    data: data,
                    total: $('#total').text(),
                    customer: $('#customer').val(),
                    service: $('input[name="service"]:checked').val(),
                    payment_amount: $('input[name="payment_amount"]').val(),
                    payment_change: $('input[name="change"]').val(),
                    discount: $('input[name="discount"]').val(),
                    note: $('#note').val(),
                },
                dataType: 'json',
                success: function (response) {
                    if (response.status == 'success') {
                        // $("body").append("<iframe src='receipt.php' style='display: none;' ></iframe>");
                        // var iframeElement = document.querySelector("iframe");
                        // iframeElement.contentWindow.print();
                        $('#menu-list').html('<object data="receipt.php" type="application/pdf" class="w-full h-full">');
                        
                        $('#print-receipt').slideUp();
                        $('#send-request').removeClass('hidden').fadeIn();
                        $('.delete-button').addClass('hidden');
                        $('#payment-amount, #discount, #customer, #note, #add-ons-to').addClass('cursor-not-allowed').attr('disabled', true);
                        $('#opField2').addClass('hidden');
                        $('#acthd').addClass('hidden');
                    } else {
                        swal("Error", response.msg, "error");
                    }
                }
            })
        }
    });

    $('#send-request').click(function () {
        var payment = $('#payment-amount').val();
        var add_ons = $('#add-ons-to').val().trim();
        
        if (add_ons !== '') {
            swal({
                icon: "warning",
                text: "Cant make an order with a value in add-ons field.",
                confirmationbutton: true,
            });
        } else if (($('tbody tr').length === 1 && $('tbody tr').text() === "No Orders Made")) {
            swal({
                icon: "warning",
                text: "No Orders Made",
                confirmationbutton: true,
            });
        } else if ($('#customer').val() == ''){
            swal({
                icon: "warning",
                text: "Please provide table no. or customer name.",
                confirmationbutton: true,
            });
        } else {
            $.ajax({
                url: "index.php?a=orders",
                dataType: 'json',
                success: function (response) {
                    if (response.status == 'success') {
                        location.reload();
                    }else {
                        swal({
                            icon: "error",
                            text: response.msg,
                            confirmationbutton: true,
                            dangerMode: true,
                        });
                    }
                }
            });
        }
    });

    $('#add-ons-to').on('click', function (){
        $(this).on('input', function() {
            if ($(this).val() !== "") {
                $.ajax({
                    url: "index.php?a=find_order",
                    type: "POST",
                    data: {
                        reference: $(this).val()
                    },
                    dataType: 'json',
                    success: function (resp) {
                        if (resp.status !== 'failed') {
                            $('#customer').removeClass('text-red-500').addClass('text-gray-700').val(resp.customer);
                            $('#info-customer').html(resp.customer);
                            $('#info-voice-no').html(resp.invoice_no);
                            $('#info-created-at').html(resp.create_at);
                            $('#info-status').html(resp.status == '' ? 'Pending' : resp.status);

                            var status = $('#info-status').text();
                            if (status == 'Pending') {
                                $('#info-status').addClass('px-1 bg-green-600 rounded shadow text-white');
                            } else {
                                $('#info-status').addClass('px-1 bg-rose-600 rounded shadow text-white');
                            }

                            $('#info-odered-list').html(resp.ordered_list);
                            $('#customer-label').addClass('flex pt-1');
                            $('#cust-profile').removeClass('hidden');
                            $('#order_id').val(resp.order_id);
                        } else {
                            $('#customer-label').removeClass('flex pt-1');
                            $('#cust-profile').addClass('hidden');
                            $('#customer').addClass('placeholder:text-red-500').attr('placeholder', resp.msg);
                            $('#order_id').val('');
                        }
                    }
                });
            } else {
                $('#customer').removeClass('placeholder:text-red-500').addClass('text-gray-700').attr('placeholder', 'Table #');
                $('#customer-label').removeClass('flex pt-1');
                $('#cust-profile').addClass('hidden');
                $('#customer').val('');
                $('#order_id').val('');
            }
        });
    })

    $('#add-ons').on('click', function(){
        var payment = $('#payment-amount').val();
        var add_ons = $('#add-ons-to').val().trim();
        
        if (($('tbody tr').length === 1 && $('tbody tr').text() === "No Orders Made")) {
            swal({
                icon: "warning",
                text: "No add-ons made.",
                confirmationbutton: true,
                dangerMode: true,
            });
        } else if ($('#customer').val() == '' || add_ons == ''){
            swal({
                icon: "warning",
                text: "Table number not found.",
                buttons: false,
                timer: 2000,
            });
        } else {
            var data = [];
            $('tbody tr').each(function () {
                var name = $(this).find('td:first-child').text();
                var quantity = $(this).find('td:nth-child(3)').text();
                var price = $(this).find('td:nth-child(2)').text();
                data.push({
                    name: name,
                    quantity: quantity,
                    price: price
                });
            }); 
    
            $.ajax({
                url: 'index.php?a=addons',
                method: 'POST',
                data: {
                    data: data,
                    order_id: $('#order_id').val(),
                    total: $('#total').text(),
                    final_total: $('#finaltotal').html(),
                    customer: $('#customer').val(),
                    invoice_no:  $('#add-ons-to').val(),
                    service: $('input[name="service"]:checked').val(),
                    payment_amount: $('input[name="payment_amount"]').val(),
                    payment_change: $('input[name="change"]').val(),
                    discount: $('input[name="discount"]').val(),
                    note: $('#note').val(),
                },
                dataType: 'json',
                success: function (resp) {
                    if (resp.status == 'success') {
                        location.reload();
                    } else {
                        swal({
                            icon: "warning",
                            text: resp.msg,
                            confirmationbutton: true,
                            dangerMode: true,
                        })
                    }
                }
            });
        }
    });

    $('#addons-label').click(function() {
        $('#add-ons-to').val('');
        $('#customer').removeClass('placeholder:text-red-500').addClass('text-gray-700').attr('placeholder', 'Table #');
        $('#customer-label').removeClass('flex pt-1');
        $('#cust-profile').addClass('hidden');
        $('#customer').val('');
        $('#order_id').val('');
    });
});