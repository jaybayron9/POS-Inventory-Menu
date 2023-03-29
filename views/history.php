<link rel="stylesheet" href="public/assets/css/table.css">

<section class="container mx-auto px-5">
    <div class="flex my-4">
        <p class="font-bold">SALE:
            <span class="font-semibold text-gray-50">
                <?php
                echo '&nbsp;&#8369;&nbsp;' . number_format($menu->total_sale(), 2);
                ?>
            </span>
        </p>

        <div class="ml-auto mr-3 bg-gradient-to-r p-1 px-1 from-red-500 to-gray-700 text-white hover:text-red-200 rounded-md">
            <a href="index.php?a=today_report" title="Generate Report">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m.75 12l3 3m0 0l3-3m-3 3v-6m-1.5-9H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                </svg>
            </a>
        </div>
        <a href="#" id="clear-history" title="Reset history" class="reset-sale bg-gradient-to-r p-1 px-1 from-red-500 to-gray-700 text-white hover:text-red-200 rounded-full">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
            </svg>
        </a>
    </div>
    <div class="bg-gray-50 p-4 rounded-lg shadow-md mb-5">
        <table id="historytbl" class="stripe hover" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
            <thead>
                <tr>
                    <th data-priority="1">#</th>
                    <th data-priority="2">OrderID</th>
                    <th data-priority="8">Purchase</th>
                    <th data-priority="6">Total</th>
                    <th data-priority="4" class="px-2">Service</th>
                    <th data-priority="5">Status</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1;
                foreach (History::getHistory() as $cust) { ?>
                    <tr>
                        <td><?= $i++ ?></td>
                        <td class="capitalize text-gray-700"><span class="ml-5"><?= $cust['invoice_no'] ?></span></td>
                        <td>
                            <?php 
                                $name = array_filter(explode(", ", $cust['name']));
                                $price = array_filter(explode(", ", $cust['price']));
                                $quantity = array_filter(explode(", ", $cust['quantity']));
                                
                                for ($i = 0; $i < count($name); $i++) {
                                    echo "<span class='bg-gray-200 rounded-l m-0 px-2 shadow'>" 
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
                        </td>
                        <td><span class="text-green-600">₱</span> <?= floatval($cust['total']) ?></td>
                        <td>
                            <div class="bg-gradient-to-r <?= $cust['service'] == "TK" ? 'from-blue-400 to-gray-700' : 'from-orange-400 to-orange-700' ?> px-1 text-white px-2 rounded text-center">
                                <?= $cust['service'] == "TK" ? 'Take Out' : 'Dine In' ?>
                            </div>
                        </td>
                        <td>
                            <div class="bg-gradient-to-r <?= $cust['status'] == "" ? 'from-green-400 to-green-700' : 'from-rose-400 to-rose-700' ?> px-1 text-white px-2 rounded text-center">
                                <?= $cust['status'] == "" ? 'Pending' : 'Served' ?>
                            </div>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</section>

<script>
    $(document).ready(function() {
        $('#historytbl').DataTable({
                "paging": true,
                responsive: true
            })
            .columns.adjust()
            .responsive.recalc();

        $('#clear-history').click(function(e) {
            e.preventDefault();
            if (!confirm('Are you sure you want to reset the history?')) {
                return false;
            } else {
                $.ajax({
                    url: 'index.php?h=clear_history',
                    dataType: 'json',
                    success: function(resp) {
                        if (resp.status == 'success') {
                            window.location.reload();
                        }
                    }
                });
            }
        });
    });
</script>