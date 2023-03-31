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
        $('#meals-menu').hide();
        $('#drinks-menu').show();
    });

    $('#nav-meals').click(function () {
        $('#meals-menu').show();
        $('#drinks-menu').hide();
    })

    // Keypad
    $(".key").click(function () {
        var value = $(this).text();
        var paymentAmount = $("#payment-amount");
        paymentAmount.val(paymentAmount.val() + value);
        discounted();
        updateTotal();
    });

    $("#backspace").click(function () {
        var paymentAmount = $("#payment-amount");
        paymentAmount.val(paymentAmount.val().slice(0, -1));
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

        $('tbody tr td:first-child').each(function () {
            if ($(this).text() === name) {
                exist = true;
                $quantityCell = $(this).closest('tr').find('td:nth-child(3)');
                $priceCell = $(this).closest('tr').find('td:nth-child(2)');
                return false;
            }
        });

        if (isNaN(price)) {
            console.log("Invalid price value");
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
                    row += '<td class="text-left text-gray-900 pl-2 text-l font-medium">' + name + '</td>';
                    row += '<td class="text-gray-900">' + price + '</td>';
                    row += '<td class="text-gray-900 quantity-cell">1</td>'; 
                    row += '<td class="text-gray-900"><button class="delete-button"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mt-1 text-red-500"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg></button></td>';
                row += '</tr>';

            $('tbody').append(row);
            $('tr.product-row').removeClass('bg-gray-200'); 
            $('tr.product-row:first-child').addClass('bg-gray-200'); 
        }

        updateTotal();
        discounted();
        change();
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
            url: 'index.php?a=unset',
            success: function (data) {
                // console.log(data);
            }
        })
    }, 2000);

    // Validate and Send request to print and place order
    var printDialogClosed = false;

    $('#print-receipt').click(function () {
        var payment = $('#payment-amount').val();
        console.log(payment);
        if (($('tbody tr').length === 1 && $('tbody tr').text() === "No Orders Made")) {
            swal({
                icon: "warning",
                text: "No Orders Made",
                buttons: false,
                timer: 1500,
            })
        } else if (payment == "" && payment == 0) {
            swal({
                icon: "warning",
                text: "Please provide payment amount.",
                buttons: false,
                timer: 1500,
            })
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

            var total = $('#total').text();
            var service = $('input[name="service"]:checked').val();
            var payment_amout = $('input[name="payment_amount"]').val();
            var payment_change = $('input[name="change"]').val();
            var discount = $('input[name="discount"]').val();

            $.ajax({
                type: "POST",
                url: "index.php?a=print",
                data: {
                    data: data,
                    total: total,
                    service: service,
                    payment_amount: payment_amout,
                    payment_change: payment_change,
                    discount: discount,
                },
                dataType: 'json',
                success: function (response) {
                    if (response.status == 'success') {
                        var iframe = "<iframe src='receipt.php' style='display: none;' ></iframe>";
                        $("body").append(iframe);
                        var iframeElement = document.querySelector("iframe");
                        iframeElement.contentWindow.print();
                        setTimeout(checkPrintDialogClosed, 2000);
                    } else {
                        alert(response.msg);
                        console.log(response.msg);
                    }
                }
            })
        }
    });

    window.onbeforeprint = function () {
        printDialogClosed = false;
    }

    window.onafterprint = function () {
        printDialogClosed = true;
    }

    function checkPrintDialogClosed() {
        if (!printDialogClosed) {
            $('#send-request').removeClass('hidden').slideDown();
        }
    }

    $('#send-request').click(function () {
        var payment = $('#payment-amount').val();
        
        if (($('tbody tr').length === 1 && $('tbody tr').text() === "No Orders Made")) {
            swal({
                icon: "warning",
                text: "No Orders Made",
                buttons: false,
                timer: 1500,
            })
            // alert("No Orders Made");
        } else if (payment == "" && payment == 0) {
            swal({
                icon: "warning",
                text: "Please provide payment amount.",
                buttons: false,
                timer: 1500,
            })
        } else {
            $.ajax({
                url: "index.php?a=orders",
                dataType: 'json',
                success: function (response) {
                    if (response.status == 'success') {
                        swal({
                            icon: "success",
                            text: "Order Placed",
                            buttons: false,
                            timer: 1500,
                        });
                        setTimeout(() => {
                            location.reload(true);
                        }, 1600);
                    }else {
                        alert(response.msg)
                    }
                }
            });
        }
    });
});