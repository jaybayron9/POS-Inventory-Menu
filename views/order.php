<?php require(view('components/sound-notification')); ?>

<div class="h-screen">
    <section class="mx-auto">
        <?php
        if (!$menu->check_order()) {
        ?>
            <div class="px-4 py-2">
                <h1 class="font-bold text-3xl mb-2 text-gray-50">Recent Orders</h1>
                <div class="grid xl:grid-cols-3 md:grid-cols-3 sm:grid-cols-2 grid-cols-1 gap-4 mb-4">
                    <?php
                    foreach ($menu->orders() as $order) {
                    ?>
                        <div class="relative shadow-xl rounded overflow-y-auto p-2 bg-gray-200" style="height: 480px; max-height: 480px;">
                            <table class="w-full text-sm text-left">
                                <div class="relative">
                                    <!-- Check -->
                                    <a data-row-data="<?= $order['order_id'] ?>" class="done hover:cursor-pointer duration-200 absolute right-0 top-0 text-green-500 bg-white hover:text-green-400 hover:bg-gray-100 p-2 rounded-full text-8xl border border-gray-200 shadow">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-8 h-8">
                                            <path fill-rule="evenodd" d="M19.916 4.626a.75.75 0 01.208 1.04l-9 13.5a.75.75 0 01-1.154.114l-6-6a.75.75 0 011.06-1.06l5.353 5.353 8.493-12.739a.75.75 0 011.04-.208z" clip-rule="evenodd" />
                                        </svg>
                                    </a>
                                    <!-- Print -->
                                    <!-- <a data-row-data="<?= $order['order_id'] ?>" class="print hover:cursor-pointer duration-200 absolute right-0 top-14 text-gray-500 bg-white hover:text-gray-400 hover:bg-gray-100 p-2 rounded-full text-8xl border border-gray-200 shadow">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0110.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0l.229 2.523a1.125 1.125 0 01-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0021 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 00-1.913-.247M6.34 18H5.25A2.25 2.25 0 013 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 011.913-.247m10.5 0a48.536 48.536 0 00-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5zm-3 0h.008v.008H15V10.5z" />
                                        </svg>
                                    </a> -->
                                </div>
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50 ">
                                    <div class="grid border-b border-gray-300 grid-cols-3 gap-1 px-2 py-1 pb-2 pr-8">
                                        <p title="Customer name" class="rounded px-2 flex bg-gradient-to-r from-rose-700 to-rose-400 text-white px-2 capitalize">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-6 mr-2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                                            </svg>
                                            <?= $order['invoice_no'] ?>
                                        </p>
                                        <p title="Customer name" class="rounded px-2 flex bg-gradient-to-r <?= $order['service'] == 'TK' ? 'from-blue-400 to-blue-700' : 'from-orange-400 to-orange-700' ?> text-white px-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-6 mr-2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M10.05 4.575a1.575 1.575 0 10-3.15 0v3m3.15-3v-1.5a1.575 1.575 0 013.15 0v1.5m-3.15 0l.075 5.925m3.075.75V4.575m0 0a1.575 1.575 0 013.15 0V15M6.9 7.575a1.575 1.575 0 10-3.15 0v8.175a6.75 6.75 0 006.75 6.75h2.018a5.25 5.25 0 003.712-1.538l1.732-1.732a5.25 5.25 0 001.538-3.712l.003-2.024a.668.668 0 01.198-.471 1.575 1.575 0 10-2.228-2.228 3.818 3.818 0 00-1.12 2.687M6.9 7.575V12m6.27 4.318A4.49 4.49 0 0116.35 15m.002 0h-.002" />
                                            </svg>
                                            <?= $order['service'] == 'DN' ? 'Dine in' : 'Take out'  ?>
                                        </p>
                                        <p title="Time ordered" class="rounded px-1 flex bg-gradient-to-r from-green-700 to-green-400 text-white px-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-6 mr-2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <?= date("g:i a", strtotime($order['create_at']))  ?>
                                        </p>
                                    </div>
                                    <div class="pb-5"> </div>
                                    <tr class="border-b border-gray-200">
                                        <th scope="col" class="px-4 py-1 rounded-tl-md">
                                            Product
                                        </th>
                                        <th scope="col" class="px-4 py-1 rounded-tr-md">
                                            Quantity
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $fname = explode(", ", $order['name']);
                                    $name = array_filter($fname);

                                    $fquantity  = array_map('intval', explode(", ", $order['quantity']));
                                    $quantity = array_filter($fquantity);

                                    for ($i = 0; $i < count($name); $i++) {
                                    ?>
                                        <tr class="bg-white border-b hover:bg-rose-200 capitalize">
                                            <th scope="row" class="px-6 py-2 font-medium text-gray-900 whitespace-nowrap">
                                                <?= $name[$i] ?>
                                            </th>
                                            <th scope="row" class="px-6 py-2 font-medium text-gray-900 whitespace-nowrap">
                                                <?= $quantity[$i] ?>
                                            </th>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    <?php } ?>
                </div>
            </div>
        <?php
        } else {
            echo '
                <div class="">
                    <p class="font-bold text-3xl text-rose-200 pt-32 bg-rose-400 text-center">No orders</p>
                </div>
            ';
        }
        ?>
    </section>
</div>

<script>
    $(document).ready(function() {

        $('.done').click(function() {
            if (confirm('Are you sure this order is completed?')) {
                $.ajax({
                    type: "POST",
                    url: "index.php?a=up_order",
                    data: {
                        order_id: $(this).data('row-data')
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.status == 'success') {
                            window.location.reload();
                        } else {
                            location.reload();
                            alert(response.msg);
                        }
                    }
                });
            }
        });

        $.ajax({
            url: "index.php?a=ring_notif",
            dataType: "json",
            success: function(resp) {
                if (resp.status == 'success') {
                    $('#notificationSound')[0].play();
                    setInterval(function() {
                        $.ajax({
                            url: "index.php?a=pause_bell",
                            dataType: "json",
                            success: function(resp) {
                                if (resp.status == 'success') {
                                    $('#notificationSound')[0].pause();
                                }
                            }
                        })
                    }, 5000);
                }
            }
        });

        setInterval(function() {
            location.reload();
        }, 10000);
    });
</script>