<link rel="stylesheet" href="public/assets/css/table.css">

<section class="container mx-auto px-5">
    <div class="bg-white p-4 rounded shadow-md mb-5 mt-5" style="background-image: url('public/storage/eximage/bg3.png'); background-size: 20px 20px; background-repeat: repeat;">
        <div class="flex flex-wrap gap-4 mb-3">
            <div class="flex">
                <label for="search_date" class="block mt-1 font-medium">Date :&nbsp;</label>
                <input type="date" id="search_date" name="date" class="border-none p-1">
            </div>
        </div>
        <table id="historytbl" class="stripe hover" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
            <thead>
                <tr>
                    <th data-priority="1">InvNo.</th>
                    <th data-priority="2">Table</th>
                    <th data-priority="3">Purchase</th>
                    <th data-priority="4">Total</th>
                    <th data-priority="7">Date</th>
                    <th data-priority="5">Status</th>
                    <th data-priority="6">Receipt</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach (History::getHistory() as $cust) { ?>
                    <tr>
                        <td class="text-gray-700"><?= $cust['invoice_no'] ?></td>
                        <td class="capitalize whitespace-nowrap"><?= $cust['customer'] !== '' ? $cust['customer'] : $cust['invoice_no'] ?></td>
                        <td>
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
                        <td class="whitespace-nowrap"><span class="text-green-600">₱</span> <?= floatval($cust['total']) ?>
                        <td class="whitespace-nowrap"><?= date('Y-m-d', strtotime($cust['create_at'])) ?></td>
                        <td>
                            <div class="font-medium bg-gradient-to-r <?= $cust['payment_status'] == "Paid" ? 'from-sky-400 to-sky-700' : 'from-gray-400 to-gray-500' ?> px-1 text-white px-2 rounded text-center whitespace-nowrap uppercase">
                                <?= $cust['payment_status'] ?>
                            </div>
                        </td>
                        <td>
                            <a href="#" data-modal-toggle="receipt-modal" data-row-data="<?= $cust['total'] . ', ' . $cust['order_id'] ?>" class="row flex bg-gradient-to-r from-gray-500 to-gray-700 text-gray-50 hover:text-gray-200 font-medium text-sm px-3 py-1 text-center inline-flex items-center border border-gray-500 hover:border-gray-100">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 14.25l6-6m4.5-3.493V21.75l-3.75-1.5-3.75 1.5-3.75-1.5-3.75 1.5V4.757c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0111.186 0c1.1.128 1.907 1.077 1.907 2.185zM9.75 9h.008v.008H9.75V9zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm4.125 4.5h.008v.008h-.008V13.5zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                </svg>
                                Receipt
                            </a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</section>

<?php require(view('components/receipt-modal')) ?>

<script>
    $(document).ready(function() {
        var table = $('#historytbl').DataTable({
                responsive: true,
                columns: [
                    { title: 'InvNo.' },
                    { title: 'Table' },
                    { title: 'Purchase' },
                    { title: 'Total' },
                    { title: 'Date' },
                    { title: 'Status' },
                    { title: 'Receipt' },
                ],
            })
            .columns.adjust()
            .responsive.recalc();

        $.fn.dataTable.ext.search.push(
            function(settings, data, dataIndex) {
                var searchDate = $('#search_date').val();
                var date = data[4]; // assuming the date is in the first column
                if (searchDate === '') {
                    return true;
                }
                if (date === searchDate) {
                    return true;
                }
                return false;
            }
        );

        $('#search_date').on('change', function() {
            table.draw();
        });

        var today = new Date().toISOString().substr(0, 10);
        $('#search_date').val(today);
        table.draw();

        $('.row').click(function() {
            var data = $(this).data('row-data');
            var values = data.split(",");

            var total_discount = parseInt(values[0]);
            var secondValue = parseInt(values[1]);

            $('#total').html(Number(total_discount).toFixed(2));
            $('#order_id').val(secondValue);
        });
    });
</script>