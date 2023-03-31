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
                        <div class="relative shadow-xl rounded overflow-y-auto p-2 bg-gray-200" style="height: 480px; max-height: 480px; background-image: url('public/storage/eximage/bg3.png'); background-repeat: repeat; background-size: 25px 25px;">
                            <table class="w-full text-sm text-left">
                                <div class="relative">
                                    <!-- Check -->
                                    <a data-row-data="<?= $order['order_id'] ?>" title="Done Order" class="done hover:cursor-pointer duration-200 absolute right-0 top-0 text-green-500 bg-white hover:text-green-400 hover:bg-gray-100 p-2 rounded-full text-8xl border border-gray-200 shadow">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-8 h-8">
                                            <path fill-rule="evenodd" d="M19.916 4.626a.75.75 0 01.208 1.04l-9 13.5a.75.75 0 01-1.154.114l-6-6a.75.75 0 011.06-1.06l5.353 5.353 8.493-12.739a.75.75 0 011.04-.208z" clip-rule="evenodd" />
                                        </svg>
                                    </a>

                                    <!-- Cancel Order -->
                                    <a data-row-data="<?= $order['order_id'] ?>" title="Cancel Order" class="cancel hover:cursor-pointer duration-200 absolute right-1 top-16 text-red-500 bg-white hover:text-red-400 hover:bg-gray-100 p-2 rounded-full border border-gray-200 shadow">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5m6 4.125l2.25 2.25m0 0l2.25 2.25M12 13.875l2.25-2.25M12 13.875l-2.25 2.25M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
                                        </svg>
                                    </a>
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
                                        <tr class="bg-white border-b hover:bg-green-200 capitalize">
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
            <div class="flex justify-center h-screen">
                <p class="m-auto text-5xl font-bold text-gray-300">No Orders</p>
            </div>
            ';
        }
        ?>
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

        $('.cancel').click(function(){
            swal({
                    title: "Do you want to cancel this order?",
                    icon: "warning",
                    buttons: ["No", "Yes"],
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
                } else {
                    swal({
                        text: "Orders Safe",
                        icon: "error",
                        buttons: false,
                        timer: 1000,
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

        function refreshOrder(time = 10000){
            setInterval(function() {
                location.reload();
            }, time);
        }
        refreshOrder();
    });
</script>