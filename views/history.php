<link rel="stylesheet" href="public/assets/css/table.css">

<section class="container mx-auto px-5">
    <div class="bg-white p-4 rounded shadow-md mb-5 mt-5" style="background-image: url('public/storage/eximage/bg3.png'); background-size: 20px 20px; background-repeat: repeat;">
        <div class="flex flex-wrap justify-center items-center gap-4 mb-3">
            <p class="font-light mr-5">Total Sale:
                <span class="text-green-500">
                    &#8369;
                </span>
                <span id="sale" class="font-semibold">
                    <!-- Sales goes here -->
                </span>
            </p>

            <div class="flex">
                <label for="start_date" class="block mt-1 font-light">From :&nbsp;</label>
                <input type="date" id="start_date" name="start_date" class="border rounded-lg px-4 p-1">
            </div>

            <div class="flex">
                <label for="end_date" class="block mt-1 font-light">To :&nbsp;</label>
                <input type="date" id="end_date" name="end_date" class="border rounded-lg px-4 p-1">
            </div>

            <div>
                <button id="search_button" class="bg-blue-500 text-white px-4 py-1 rounded-l-lg hover:bg-blue-700">Search</button>
                <button id="clear_button" class="bg-gray-400 text-white px-4 py-1 rounded-r-lg hover:bg-gray-600">Clear</button>
            </div>

            <a href="#" id="today" title="Set Today Date" class="rounded-md flex bg-gradient-to-r from-red-500 to-gray-700 text-white hover:text-red-200 font-medium text-sm px-3 py-1 text-center inline-flex items-center border border-gray-500 hover:border-rose-400">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                </svg>
                Today
            </a>

            <button id="dropdownHoverButton" data-dropdown-toggle="dropdownHover" data-dropdown-trigger="hover" class="
            rounded-md flex bg-gradient-to-r from-red-500 to-gray-700 text-white hover:text-red-200 font-medium text-sm px-3 py-1 text-center inline-flex items-center border border-gray-500 hover:border-rose-400" type="button">Export
                <svg class="w-4 h-4 ml-2" aria-hidden="true" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
            </button>
            <!-- Dropdown menu -->
            <div id="dropdownHover" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 bg-gray-100">
                <ul class="py-2 text-sm text-gray-700 text-gray-800" aria-labelledby="dropdownHoverButton">
                    <li>
                        <a href="#" id="exportcsv" class="flex block px-8 py-2 hover:bg-gray-600 hover:text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-3">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m.75 12l3 3m0 0l3-3m-3 3v-6m-1.5-9H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                            </svg>
                            CSV
                        </a>
                    </li>
                    <li>
                        <a href="#" id="exportpdf" class="flex block px-8 py-2 hover:bg-gray-600 hover:text-red-500 line-through text-red-500">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-3">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                            </svg>
                            PDF 
                        </a>
                    </li>
                </ul>
            </div>
            <a href="#" id="clear-history" title="Reset history" class="reset-sale bg-gradient-to-r p-1 px-1 from-red-500 to-gray-700 text-white hover:text-red-200 rounded-full border border-gray-500 hover:border-rose-400">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
                </svg>
            </a>
        </div>
        <table id="historytbl" class="stripe hover" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
            <thead>
                <tr>
                    <th data-priority="1">OrderID</th>
                    <th data-priority="2"></th>
                    <th data-priority="3">InvoiceNo.</th>
                    <th data-priority="6">Customer</th>
                    <th data-priority="11">Purchase</th>
                    <th data-priority="8">Total</th>
                    <th data-priority="9">NewTotal</th>
                    <th data-priority="5">Service</th>
                    <th data-priority="4">Status</th>
                    <th data-priority="10">Created</th>
                    <th data-priority="7">Time</th>
                    <th data-priority="12">Update</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                foreach (History::getHistory() as $cust) { ?>
                    <tr>
                        <td class="ml-3"><?= $no++ ?></td>
                        <td class="text-center"><input type="checkbox" data-row-data="<?= $cust['order_id'] ?>" id="" class="select " value="<?= $cust['order_id'] ?>"></td>
                        <td class="capitalize whitespace-nowrap"><?= $cust['customer'] !== '' ? $cust['customer'] : $cust['invoice_no'] ?></td>
                        <td class="text-gray-700"><?= $cust['invoice_no'] ?></td>
                        <td class="whitespace-nowrap">
                            <?php
                            $name = array_filter(explode(", ", $cust['name']));
                            $price = array_filter(explode(", ", $cust['price']));
                            $quantity = array_filter(explode(", ", $cust['quantity']));

                            for ($i = 0; $i < count($name); $i++) {
                                echo "<span class='bg-gray-200 rounded-l m-0 px-2 shadow '>"
                                    . $name[$i] .
                                    "</span>";
                                echo "<span class='bg-gray-200 m-0 px-1 bg-sky-300 shadow'>"
                                    . $quantity[$i] .
                                    "</span>";
                                if (empty($price[$i])) {
                                    echo "<span class='bg-gray-200 rounded-r m-0 px-1 bg-green-300 shadow'></span>";
                                } else {
                                    echo "<span class='bg-gray-200 rounded-r m-0 px-1 bg-green-300 shadow'>"
                                        . $price[$i] .
                                        "</span>";
                                }
                                echo "<span class='text-red-700 m-1'></span>";
                            }
                            ?>
                        </td>
                        <td><span class="text-green-600">₱</span> <?= floatval($cust['total']) ?></td>
                        <td><span class="text-green-600">₱</span> <?= floatval($cust['total_discount']) ?></td>
                        <td>
                            <div class="font-medium bg-gradient-to-r <?= $cust['service'] == "TK" ? 'from-blue-400 to-gray-700' : 'from-orange-400 to-orange-700' ?> px-1 text-white px-2 rounded text-center whitespace-nowrap">
                                <?= $cust['service'] == "TK" ? 'TAKE OUT' : 'DINE IN' ?>
                            </div>
                        </td>
                        <td>
                            <div class="font-medium bg-gradient-to-r <?= $cust['status'] == "" ? 'from-green-400 to-green-700' : 'from-rose-400 to-rose-700' ?> px-1 text-white px-2 rounded text-center whitespace-nowrap">
                                <?= $cust['status'] == "" ? 'PENDING' : 'SERVED' ?>
                            </div>
                        </td>
                        <td class="whitespace-nowrap">
                            <?php
                            echo date('Y-m-d', strtotime($cust['create_at']))
                            ?>
                        </td>
                        <td class="whitespace-nowrap">
                            <?php
                            echo date('g: i A', strtotime($cust['create_at']))
                            ?>
                        </td>
                        <td class="whitespace-nowrap">
                            <?php
                            echo date('g: i A', strtotime($cust['update_at']))
                            ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</section>

<script>
    $(document).ready(function() {
        var table = $('#historytbl').DataTable({
                "lengthMenu": [10, 25, 50, 100, 200, 500, 1000],
                "paging": true,
                responsive: true,
                columnDefs: [{
                    type: 'date',
                    targets: 7
                }],
                columns: [
                    { title: '' },
                    { title: '<input type="checkbox" name="" id="selectAll">' },
                    { title: 'Customer' },
                    { title: 'InvoiceNo.' },
                    { title: 'Purchase' },
                    { title: 'Total' },
                    { title: 'NewTotal' },
                    { title: 'Service' },
                    { title: 'Status' },
                    { title: 'Created' },
                    { title: 'Time' },
                    { title: 'Updated' }
                ]
            })
            .columns.adjust()
            .responsive.recalc();

        $.fn.dataTable.ext.search.push(
            function(settings, data, dataIndex) {
                var minDate = $('#start_date').val();
                var maxDate = $('#end_date').val();
                var date = data[9]; // assuming the date is in the first column
                if (minDate === '' || maxDate === '') {
                    return true;
                }
                if (date >= minDate && date <= maxDate) {
                    return true;
                }
                return false;
            }
        );

        $('#search_button').on('click', function() {
            table.draw();
            setSale();
        });

        $('#clear_button').on('click', function() {
            $('#start_date').val('');
            $('#end_date').val('');
            table.draw();
            setSale();
        });

        var today = new Date().toISOString().substr(0, 10);
        $('#today').click(function() {
            $('#start_date').val(today);
            $('#end_date').val(today);
            table.draw();
            setSale();
        })

        $('#start_date').val(today);
        $('#end_date').val(today);
        table.draw();

        $('#exportcsv').on('click', function() {
            var checkboxes = $('.select');
            var rowData = [];
            checkboxes.each(function() {
                if ($(this).is(':checked')) {
                    var data = $(this).data('row-data');
                    rowData.push(data);
                }
            });

            $.ajax({
                url: 'index.php?h=toexportcsv',
                type: 'POST',
                data: {
                    'data': rowData
                },
                dataType: 'json',
                success: function(resp) {
                    if (resp.status == 'success') {
                        window.location.href = 'index.php?h=export_csv';
                        swal({
                            text: 'Exporting to CSV',
                            icon: "success",
                            buttons: false,
                            timer: 2000,
                        });
                    } else {
                        swal({
                            text: resp.msg,
                            icon: "error",
                            buttons: false,
                            timer: 2000,
                        });
                    }
                }
            });
        });

        $('#selectAll').click(function() {
            $('.select').not(this).prop('checked', this.checked);
        });

        $('#clear-history').click(function(e) {
            e.preventDefault();
            $(this).addClass('animate-spin');
            swal({
                    title: "Do you want to delete order history?",
                    icon: "warning",
                    buttons: ["No", "Yes"],
                })
                .then((willDone) => {
                    if (willDone) {
                        $.ajax({
                            url: 'index.php?h=clear_history',
                            dataType: 'json',
                            success: function(resp) {
                                if (resp.status == 'success') {
                                    $(this).removeClass('animate-spin');
                                    swal({
                                        icon: "success",
                                        text: "History Deleted Successfully",
                                        buttons: false,
                                        timer: 1500,
                                    });
                                    setTimeout(() => {
                                        location.reload(true);
                                    }, 1600);
                                }
                            }
                        });
                    } else {
                        $(this).removeClass('animate-spin');
                        swal({
                            text: 'History not deleted',
                            icon: "error",
                            buttons: false,
                            timer: 2000,
                        });
                    }
                });
        });

        $('#exportpdf').click(function() {
            swal({
                text: 'Exporting to PDF is unavailable',
                icon: "warning",
                buttons: false,
                timer: 2000,
            })
        });
        
        function setSale() {
            var startDate = $('#start_date').val();
            var endDate = $('#end_date').val();
            $.ajax({
                url: 'index.php?h=getsale',
                method: 'POST',
                data: {
                    start_date : startDate,
                    end_date : endDate
                },
                success: function(resp) {
                    $('#sale').html(resp);
                }
            });
        }
        setInterval(setSale(), 2000);
    });
</script>