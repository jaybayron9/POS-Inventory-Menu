<section class="h-screen">
    <div class="py-8 px-4 mx-auto max-w-screen-xl lg:px-6">
        <div class="max-w-screen-md mb-8">
            <h2 class="text-4xl tracking-tight font-extrabold text-gray-900"> <span class="text-transparent bg-clip-text bg-gradient-to-r from-red-500 to-gray-900">HOTPLATE</span> SIZZLING HOUSE</h2>
        </div>
        <div class="space-y-8 grid lg:grid-cols-4 md:grid-cols-2 gap-6 space-y-0">
            <div class="p-2 rounded shadow-md bg-white">
                <div id="sale" class="text-2xl font-bold"></div>
                <div class="lg:flex gap-x-3">
                    <label class="mb-2 text-xl font-semibold">Total Sale</label>
                    <select name="" id="day-sale" class="h-8 p-1 rounded ml-auto">
                        <option value="today">Today</option>
                        <option value="yesterday">Yesterday</option>
                        <option value="last-7-days">7 Days</option>
                        <option value="last-30-days">30 Days</option>
                    </select>
                </div>
            </div>
            <div class="p-2 rounded shadow-md bg-white">
                <div id="customer" class="text-2xl font-bold"></div>
                <div class="lg:flex gap-x-3">
                    <label class="mb-2 text-xl font-semibold whitespace-nowrap">Total Customers</label>
                    <select name="" id="day-customer" class="h-8 p-1 rounded ml-auto">
                        <option value="today">Today</option>
                        <option value="yesterday">Yesterday</option>
                        <option value="last-7-days">7 Days</option>
                        <option value="last-30-days">30 Days</option>
                    </select>
                </div>
            </div>
            <div class="p-2 rounded shadow-md bg-white">
                <div id="product-sale" class="text-2xl font-bold"></div>
                <label class="mb-2 text-xl font-semibold ">Total Product Sale</label>
            </div>
            <div class="p-2 rounded shadow-md bg-white">
                <div id="aov" class="text-2xl font-bold"></div>
                <label class="mb-2 text-xl font-semibold whitespace-nowrap">Average Order Value</label>
            </div>
            <div class="p-2 rounded shadow-md bg-white">
                <div id="thebest" class="text-2xl font-bold"></div>
                <label class="mb-2 text-xl font-semibold">Best Seller</label>
            </div>
            <div class="p-2 rounded shadow-md bg-white">
                <div id="pending" class="text-2xl font-bold"></div>
                <label class="mb-2 text-xl font-semibold">Pending Orders</label>
            </div>
            <div class="p-2 rounded shadow-md bg-white">
                <div id="unpaid" class="text-2xl font-bold"></div>
                <label class="mb-2 text-xl font-semibold">Unpaid Orders</label>
            </div>
            <div class="p-2 rounded shadow-md bg-white">
                <div id="total-product" class="text-2xl font-bold"></div>
                <label class="mb-2 text-xl font-semibold">Total Products</label>
            </div>
            <div class="p-2 rounded shadow-md bg-white">
                <div id="available" class="text-2xl font-bold"></div>
                <label class="mb-2 text-xl font-semibold">Available Products</label>
            </div>
            <div class="p-2 rounded shadow-md bg-white">
                <div id="unvailable" class="text-2xl font-bold"></div>
                <label class="mb-2 text-xl font-semibold">Unavailable Products</label>
            </div>
            <div class="p-2 rounded shadow-md bg-white">
                <div id="reorder" class="text-2xl font-bold"></div>
                <label class="mb-2 text-xl font-semibold">Reorder Alert</label>
            </div>
            <div class="p-2 rounded shadow-md bg-white">
                <div id="low" class="text-2xl font-bold"></div>
                <label class="mb-2 text-xl font-semibold">Low Stock</label>
            </div>
            <div class="p-2 rounded shadow-md bg-white">
                <div id="out-stock" class="text-2xl font-bold"></div>
                <label class="mb-2 text-xl font-semibold">Out Of Stock</label>
            </div>
            <div class="p-2 rounded shadow-md bg-white">
                <div id="total-staffs" class="text-2xl font-bold"></div>
                <label class="mb-2 text-xl font-semibold">Total Staffs</label>
            </div>
        </div>
    </div>
</section>

<script>
    $(document).ready(function() {
        $.ajax({
            url: 'index.php?d=sale',
            method: 'POST',
            data: {
                totalSale: 'yesterday'
            },
            success: function(data) {
                $('#sale').html(data);
                $('#day-sale').val('yesterday');
            }
        });

        $('#day-sale').change(function() {
            var totalSale = $(this).val();
            $.ajax({
                url: 'index.php?d=sale',
                method: 'POST',
                data: {
                    totalSale: totalSale
                },
                success: function(data) {
                    $('#sale').html(data);
                }
            });
        });

        $.ajax({
            url: 'index.php?d=customer',
            method: 'POST',
            data: {
                totalCustomer: 'yesterday'
            },
            success: function(data) {
                $('#customer').html(data);
                $('#day-customer').val('yesterday');
            }
        });

        $('#day-customer').change(function() {
            var totalCustomer = $(this).val();
            $.ajax({
                url: 'index.php?d=customer',
                method: 'POST',
                data: {
                    totalCustomer: totalCustomer
                },
                success: function(data) {
                    $('#customer').html(data);
                }
            });
        });

        $('#pending').load('index.php?d=pending');
        $('#unpaid').load('index.php?d=unpaid');
        $('#total-product').load('index.php?d=total-product');
        $('#reorder').load('index.php?d=reorder');
        $('#low').load('index.php?d=low');
        $('#out-stock').load('index.php?d=out-stock');
        $('#total-staffs').load('index.php?d=total-staffs');
        $('#product-sale').load('index.php?d=product-sale');
        $('#thebest').load('index.php?d=thebest');
        $('#aov').load('index.php?d=aov');
        $('#unvailable').load('index.php?d=unvailable');
        $('#available').load('index.php?d=available');
    });
</script>