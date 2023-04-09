<?php require(view('components/sound-notification')); ?>

<div class="h-screen">
    <section class="mx-auto">
        <?php
        if (!$menu->check_order()) {
        ?>
            <div class="p-4">
                <div class="grid xl:grid-cols-5 md:grid-cols-3 sm:grid-cols-2 grid-cols-1 gap-3 mb-4">
                    <?php
                    foreach ($menu->orders() as $order) {
                    ?>
                        <div class="relative shadow-xl rounded overflow-y-auto overflow-x-auto p-2 bg-gray-50" style="max-height: 380px;">
                            <table class="text-sm text-left w-full">
                                <div class="relative">
                                    <!-- Check -->
                                    <a data-row-data="<?= $order['order_id'] ?>" title="Done Order" class="done hover:cursor-pointer duration-200 absolute right-0 top-0 text-green-500 bg-white hover:text-green-400 hover:bg-gray-100 p-1 rounded-full text-8xl border border-gray-200 shadow">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-8 h-8">
                                            <path fill-rule="evenodd" d="M19.916 4.626a.75.75 0 01.208 1.04l-9 13.5a.75.75 0 01-1.154.114l-6-6a.75.75 0 011.06-1.06l5.353 5.353 8.493-12.739a.75.75 0 011.04-.208z" clip-rule="evenodd" />
                                        </svg>
                                    </a>

                                    <!-- Cancel Order -->
                                    <?php if (strpos($order['name'], '+') === false) {  ?>
                                        <a data-row-data="<?= $order['order_id'] ?>" title="Cancel Order" class="cancel hover:cursor-pointer duration-200 absolute right-1 top-12 text-red-500 bg-white hover:text-red-400 hover:bg-gray-100 p-1 rounded-full border border-gray-200 shadow">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5m6 4.125l2.25 2.25m0 0l2.25 2.25M12 13.875l2.25-2.25M12 13.875l-2.25 2.25M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
                                            </svg>
                                        </a>
                                    <?php } ?>
                                </div>
                                <thead class="text-xs text-gray-700 bg-gray-50 ">
                                    <div class="grid border-b border-gray-300 grid-cols-3 gap-1 px-2 py-1  pr-8 whitespace-nowrap text-center bg-blue-100">
                                        <p title="Customer name" class="font-medium capitalize">
                                        <?= $order['customer'] !== '' ? $order['customer'] : $order['invoice_no'] ?>
                                        </p>
                                        <p title="Customer name" class="rounded px-5 flex bg-gradient-to-r <?= $order['service'] == 'TK' ? 'from-blue-400 to-blue-700' : 'from-orange-400 to-orange-700' ?> font-bold text-white capitalize">
                                            <?= $order['service'] == 'DN' ? 'DN' : 'TK'  ?>
                                        </p>
                                        <p title="Time ordered" class="font-medium capitalize">
                                            <?= date("g:i a", strtotime($order['create_at']))  ?>
                                        </p>
                                    </div>
                                    <div class="pb-1 border-b border-gray-200">
                                        <p title="Message" class="pb-2 text-gray-900">
                                            <span class="font-medium text-sm">Note: &nbsp;&nbsp;&nbsp; </span>  <?= $order['note']  ?>
                                            <?= strpos($order['name'], '+') !== false ? '<span class="text-blue-600 border-2 border-blue-500 font-medium px-1 whitespace-nowrap">Add-ons</span>' : ''; ?>
                                        </p>
                                    </div>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    $fname = explode(", ", $order['name']);
                                    $name = array_filter($fname);

                                    $fquantity  = array_map('intval', explode(", ", $order['quantity']));
                                    $quantity = array_filter($fquantity);
                                    
                                    for ($i = 0; $i < count($name); $i++) {
                                        if (strpos($order['name'], '+') !== false) {
                                        ?>
                                            <tr class="<?= $no % 2 !== 0 ? 'bg-gray-200' : '' ?> border-b hover:bg-green-200 capitalize">
                                                <th scope="row" class="px-1 font-light"><?= $no++ ?></th>
                                                <th scope="row" class="<?= strpos($name[$i], '+') !== false ? '' : 'line-through decoration-2 decoration-double decoration-red-500' ?> pl-6 py-1 font-medium text-gray-900 whitespace-nowrap">
                                                    <?= str_replace('+', '<span class=" bg-blue-500 px-1 rounded-full mr-1 font-extrabold text-1x text-white">+</span>', $name[$i]); ?>
                                                </th>
                                                <th scope="row" class="<?= strpos($name[$i], '+') !== false ? '' : 'line-through decoration-2 decoration-double decoration-red-500' ?> px-6 py-1 font-medium text-gray-900 text-right">
                                                    <?= $quantity[$i] ?>x
                                                </th>
                                            </tr>
                                        <?php 
                                        } else {
                                            ?>
                                            <tr class="<?= $no % 2 !== 0 ? 'bg-gray-200' : '' ?> border-b hover:bg-green-200 capitalize">
                                                <th scope="row" class="px-1 font-light"><?= $no++ ?></th>
                                                <th scope="row" class="pl-6 py-1 font-medium text-gray-900 whitespace-nowrap">
                                                    <?= $name[$i] ?>
                                                </th>
                                                <th scope="row" class="px-6 py-1 font-medium text-gray-900 text-right">
                                                    <?= $quantity[$i] ?>x
                                                </th>
                                            </tr>
                                            <?php
                                        }
                                    } 
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    <?php } ?>
                </div>
            </div>
        <?php } else { ?>
            <div class="flex justify-center h-screen">
                <p class="m-auto text-5xl font-bold text-gray-300">No Orders</p>
            </div>
        <?php } ?>
    </section>
</div>

<script>
    $(document).ready(function() {

        $('.done').click(function() {
            swal({
                    title: "Is this order ready to be served?",
                    icon: "warning",
                    buttons: ["No", "Yes"],
                })
                .then((willDone) => {
                    if (willDone) {
                        $.ajax({
                            type: "POST",
                            url: "index.php?a=up_order",
                            data: {
                                order_id: $(this).data('row-data')
                            },
                            dataType: 'json',
                            success: function(response) {
                                if (response.status == 'success') {
                                    swal("Order Served", {
                                        icon: "success",
                                        buttons: false,
                                        timer: 2000,
                                    });
                                    refreshOrder(2000);
                                } else {
                                    location.reload();
                                    alert(response.msg);
                                }
                            }
                        });
                    } else {
                        swal({
                            text: "Order not complete",
                            icon: "error",
                            buttons: false,
                            timer: 2000,
                        });
                    }
                });
        });

        $('.cancel').click(function() {
            swal({
                    title: "Do you want to cancel this order?",
                    icon: "warning",
                    buttons: ["No", "Yes"],
                    dangerMode: true,
                })
                .then((willDone) => {
                    if (willDone) {
                        var id = $(this).data('row-data');
                        $.ajax({
                            type: "POST",
                            url: "index.php?a=cancel_orders",
                            data: {
                                order_id: id,
                            },
                            dataType: 'json',
                            success: function(response) {
                                if (response.status == 'success') {
                                    swal("Order cancelled", {
                                        icon: "success",
                                        buttons: false,
                                        timer: 2000,
                                    });
                                    refreshOrder(1000);
                                } else {
                                    alert(response.msg);
                                }
                            }
                        });
                    }
                });
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

        function refreshOrder(time = 10000) {
            setInterval(function() {
                location.reload();
            }, time);
        }
        refreshOrder();
    });
</script>