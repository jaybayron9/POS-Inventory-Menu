<?php if (Auth::isAdmin()) { ?>

<link rel="stylesheet" href="public/assets/css/table.css">

<section class="container mx-auto px-5">
    <div class="bg-white p-4 rounded shadow-md mb-5 mt-5">
        <div class="flex gap-4 mb-3">
            <button data-dropdown-toggle="category" data-dropdown-trigger="click" class="rounded-md flex bg-gradient-to-r from-red-500 to-gray-700 text-white hover:text-red-200 font-medium text-sm px-3 py-1 text-center inline-flex items-center border border-gray-500 hover:border-rose-400" type="button">
                <?php
                switch (true) {
                    case urlIs('p=meals') || urlIs('p=product'):
                        echo 'Meals';
                        break;
                    case urlIs('p=drinks'):
                        echo 'Drinks';
                        break;
                    case urlIs('p=add-ons'):
                        echo 'Add-ons';
                        break;
                    case urlIs('p=other'):
                        echo 'Other';
                        break;
                }
                ?>
                <svg class="w-4 h-4 ml-2" aria-hidden="true" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
            </button>
            <div id="category" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 bg-gray-100">
                <ul class="py-2 text-sm text-gray-700 text-gray-800" aria-labelledby="dropdownHoverButton">
                    <li>
                        <a href="?p=meals" id="mealsbtn" class="block px-4 py-2 hover:bg-gray-600 hover:text-white">Meals</a>
                    </li>
                    <li>
                        <a href="?p=drinks" id="drinksbtn" class="block px-4 py-2 hover:bg-gray-600 hover:text-white">Drinks</a>
                    </li>
                    <li>
                        <a href="?p=add-ons" id="drinksbtn" class="block px-4 py-2 hover:bg-gray-600 hover:text-white">Add-ons</a>
                    </li>
                    <li>
                        <a href="?p=other" id="other" class="block px-4 py-2 hover:bg-gray-600 hover:text-white">Other</a>
                    </li>
                </ul>
            </div>

            <button id="" class="modal-open add-product ml-auto rounded-md flex bg-gradient-to-r from-red-500 to-gray-700 text-white hover:text-red-200 font-medium text-sm px-3 text-center inline-flex items-center border border-gray-500 hover:border-rose-400">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                Product
            </button>

            <button data-dropdown-toggle="report" data-dropdown-trigger="click" class="rounded-md flex bg-gradient-to-r from-red-500 to-gray-700 text-white hover:text-red-200 font-medium text-sm px-3 py-1 text-center inline-flex items-center border border-gray-500 hover:border-rose-400" type="button">Report
                <svg class="w-4 h-4 ml-2" aria-hidden="true" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
            </button>
            <div id="report" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 bg-gray-100">
                <ul class="py-2 text-sm text-gray-700 text-gray-800" aria-labelledby="dropdownHoverButton">
                    <li>
                        <a href="#" id="exportpdf" class="flex block px-8 py-2 hover:bg-gray-600 hover:text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-3">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                            </svg>
                            PDF
                        </a>
                    </li>
                </ul>
            </div>

            <a href="?p=product-history" class="rounded-md flex bg-gradient-to-r from-red-500 to-gray-700 text-white hover:text-red-200 font-medium text-sm px-3 py-1 text-center inline-flex items-center border border-gray-500 hover:border-rose-400" type="button">
                History
            </a>

            <a href="#" id="delete-row" title="Delete row" class="bg-gradient-to-r p-1 px-1 from-red-500 to-gray-700 text-white hover:text-red-200 rounded-full border border-gray-500 hover:border-rose-400">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                </svg>
            </a>

            <a href="#" title="clear sale" class="reset-sale bg-gradient-to-r p-1 px-1 from-red-500 to-gray-700 text-white hover:text-red-200 rounded-full border border-gray-500 hover:border-rose-400">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
                </svg>
            </a>
        </div>

        <table id="category-table" class="stripe hover" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
            <thead>
                <tr>
                    <th data-priority="1" class="text-xs"></th>
                    <th data-priority="2" class="text-xs"></th>
                    <th data-priority="3" class="text-xs">NAME</th>
                    <th data-priority="6" class="text-xs">STATUS</th>
                    <th data-priority="5" class="text-xs">PRICE</th>
                    <th data-priority="7" class="text-xs">QTY</th>
                    <th data-priority="8" class="text-xs">REORDER LEVEL</th>
                    <th data-priority="9" class="text-xs">TOTAL</th>
                    <th data-priority="10" class="text-xs">SALE</th>
                    <th data-priority="11" class="text-xs">CREATED</th>
                    <th data-priority="12" class="text-xs">UPDATED</th>
                    <th data-priority="4" class="text-xs">ACTION</th>
                    <th data-priority="13" class="text-xs">DESCRIPTION</th>
                </tr>
            </thead>
            <?php if (urlIs('p=meals') || urlIs('p=product')) { ?>
                <tbody>
                    <?php
                    $ids = 0;
                    foreach ($menu->products_menu('meals') as $productmeals) { ?>
                        <tr>
                            <td><?= $id++ ?></td>
                            <td class="text-center">
                            <input type="checkbox" data-row-data="<?= $productmeals['product_id'] ?>" id="" class="select" value="<?= $productmeals['product_id'] ?>">
                            </td>
                            <td class="flex ml-4">
                                <img src="public/storage/uploads/<?= $productmeals['picture'] !== Null ? $productmeals['picture'] : 'default.jpg' ?>" alt="Product image" class="h-10 w-10 rounded-full">
                                <p class="pt-2 ml-2 capitalize"><?= $productmeals['name'] ?></p>
                            </td>
                            <td class="text-center">
                                <select data-row-data="<?= $productmeals['product_id'] ?>" class="status-product">
                                    <option value="" selected hidden><?= $productmeals['status'] !== '' ? $productmeals['status'] : 'Status' ?></option>
                                    <option value="Available">Available</option>
                                    <option value="Unavailable">Unavailable</option>
                                </select>
                            </td>
                            <td><span class="text-green-600">₱</span> <?= $productmeals['price'] ?></td>
                            <td class="<?= $productmeals['quantity'] <= $productmeals['reorder_level'] ? 'text-red-500' : '' ?>"><?= $productmeals['quantity'] ?></td>
                            <td><input type="text" value="<?= $productmeals['reorder_level'] ?>" data-row-data="<?= $productmeals['product_id'] ?>" class="reorder myInput bg-gray-50 w-20 border border-gray-300 text-gray-900 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block px-2 py-1 text-center"></td>
                            <td class="whitespace-nowrap"><span class="text-green-600">₱</span> <?= number_format($productmeals['total']) ?></td>
                            <td class="whitespace-nowrap"><span class="text-green-600">₱</span> <?= number_format($productmeals['sale']) ?></td>
                            <td class="whitespace-nowrap"><?= date('F j, Y', strtotime($productmeals['create_at'])) ?></td>
                            <td class="whitespace-nowrap"><?= date('F j, Y', strtotime($productmeals['update_at'])) ?></td>
                            <td class="whitespace-nowrap">
                                <a href="#" data-modal-toggle="in-modal" data-row-data="<?= $productmeals['product_id'] ?>" class="in flex bg-gradient-to-r from-gray-500 to-gray-700 text-gray-50 hover:text-gray-200 font-medium text-sm px-3 py-1 text-center inline-flex items-center border border-gray-500 hover:border-gray-100">
                                    IN
                                </a>
                                <a href="#" data-modal-toggle="out-modal" data-row-data="<?=$productmeals['product_id'] ?>" class="out flex bg-gradient-to-r from-gray-500 to-gray-700 text-gray-50 hover:text-gray-200 font-medium text-sm px-3 py-1 text-center inline-flex items-center border border-gray-500 hover:border-gray-100">
                                    OUT
                                </a>
                                <a href="#" data-row-data="<?= $productmeals['product_id'] ?>" class="modal-open update-product flex bg-gradient-to-r from-gray-500 to-gray-700 text-gray-50 hover:text-gray-200 font-medium text-sm px-3 py-1 text-center inline-flex items-center border border-gray-500 hover:border-gray-100">
                                    EDIT
                                </a>
                            </td>
                            <td>
                                <?php
                                $ing = array_filter(explode(", ", $productmeals['description']));

                                for ($i = 0; $i < count($ing); $i++) {
                                    echo "<span class='bg-gray-200 capitalize rounded-md m-1 px-1 font-semibold text-gray-700'>" . $ing[$i] . "</span>";
                                }
                                ?>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            <?php } else if (urlIs('p=drinks')) { ?>
                <tbody>
                    <?php
                    foreach ($menu->products_menu('drinks') as $productdrinks) { ?>
                        <tr>
                            <td><?= $id++ ?></td>
                            <td class="text-center">
                            <input type="checkbox" data-row-data="<?= $productdrinks['product_id'] ?>" id="" class="select" value="<?= $productdrinks['product_id'] ?>">
                            </td>
                            <td class="flex ml-4">
                                <img src="public/storage/uploads/<?= $productdrinks['picture'] !== Null ? $productdrinks['picture'] : 'default.jpg' ?>" alt="Product image" class="h-10 w-10 rounded-full">
                                <p class="pt-2 ml-2 capitalize"><?= $productdrinks['name'] ?></p>
                            </td>
                            <td class="text-center">
                                <select data-row-data="<?= $productdrinks['product_id'] ?>" class="status-product">
                                    <option value="" selected hidden><?= $productdrinks['status'] !== '' ? $productdrinks['status'] : 'Status' ?></option>
                                    <option value="Available">Available</option>
                                    <option value="Unavailable">Unavailable</option>
                                </select>
                            </td>
                            <td><span class="text-green-600">₱</span> <?= $productdrinks['price'] ?></td>
                            <td class="<?= $productdrinks['quantity'] <= $productdrinks['reorder_level'] ? 'text-red-500' : '' ?>"><?= $productdrinks['quantity'] ?></td>
                            <td><input type="text" value="<?= $productdrinks['reorder_level'] ?>" data-row-data="<?= $productdrinks['product_id'] ?>" class="reorder myInput bg-gray-50 w-20 border border-gray-300 text-gray-900 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block px-2 py-1 text-center"></td>
                            <td class="whitespace-nowrap"><span class="text-green-600">₱</span> <?= number_format($productdrinks['total']) ?></td>
                            <td class="whitespace-nowrap"><span class="text-green-600">₱</span> <?= number_format($productdrinks['sale']) ?></td>
                            <td class="whitespace-nowrap"><?= date('F j, Y', strtotime($productdrinks['create_at'])) ?></td>
                            <td class="whitespace-nowrap"><?= date('F j, Y', strtotime($productdrinks['update_at'])) ?></td>
                            <td class="whitespace-nowrap">
                                <a href="#" data-modal-toggle="in-modal" data-row-data="<?= $productdrinks['product_id'] ?>" class="in flex bg-gradient-to-r from-gray-500 to-gray-700 text-gray-50 hover:text-gray-200 font-medium text-sm px-3 py-1 text-center inline-flex items-center border border-gray-500 hover:border-gray-100">
                                    IN
                                </a>
                                <a href="#" data-modal-toggle="out-modal" data-row-data="<?=$productdrinks['product_id'] ?>" class="out flex bg-gradient-to-r from-gray-500 to-gray-700 text-gray-50 hover:text-gray-200 font-medium text-sm px-3 py-1 text-center inline-flex items-center border border-gray-500 hover:border-gray-100">
                                    OUT
                                </a>
                                <a href="#" data-row-data="<?= $productdrinks['product_id'] ?>" class="modal-open update-product flex bg-gradient-to-r from-gray-500 to-gray-700 text-gray-50 hover:text-gray-200 font-medium text-sm px-3 py-1 text-center inline-flex items-center border border-gray-500 hover:border-gray-100">
                                    EDIT
                                </a>
                            </td>
                            <td>
                                <?php
                                $ing = array_filter(explode(", ", $productdrinks['description']));

                                for ($i = 0; $i < count($ing); $i++) {
                                    echo "<span class='bg-gray-200 capitalize rounded-md m-1 px-1 font-semibold text-gray-700'>" . $ing[$i] . "</span>";
                                }
                                ?>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            <?php } else if (urlIs('p=add-ons')) { ?>
                <tbody>
                    <?php
                    foreach ($menu->products_menu('add-ons') as $addons) { ?>
                        <tr>
                            <td><?= $id++ ?></td>
                            <td class="text-center">
                            <input type="checkbox" data-row-data="<?= $addons['product_id'] ?>" id="" class="select" value="<?= $addons['product_id'] ?>">
                            </td>
                            <td class="flex ml-4">
                                <img src="public/storage/uploads/<?= $addons['picture'] !== Null ? $addons['picture'] : 'default.jpg' ?>" alt="Product image" class="h-10 w-10 rounded-full">
                                <p class="pt-2 ml-2 capitalize"><?= $addons['name'] ?></p>
                            </td>
                            <td class="text-center">
                                <select data-row-data="<?= $addons['product_id'] ?>" class="status-product">
                                    <option value="" selected hidden><?= $addons['status'] !== '' ? $addons['status'] : 'Status' ?></option>
                                    <option value="Available">Available</option>
                                    <option value="Unavailable">Unavailable</option>
                                </select>
                            </td>
                            <td><span class="text-green-600">₱</span> <?= $addons['price'] ?></td>
                            <td class="<?= $addons['quantity'] <= $addons['reorder_level'] ? 'text-red-500' : '' ?>"><?= $addons['quantity'] ?></td>
                            <td><input type="text" value="<?= $addons['reorder_level'] ?>" data-row-data="<?= $addons['product_id'] ?>" class="reorder myInput bg-gray-50 w-20 border border-gray-300 text-gray-900 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block px-2 py-1 text-center"></td>
                            <td class="whitespace-nowrap"><span class="text-green-600">₱</span> <?= number_format($addons['total']) ?></td>
                            <td class="whitespace-nowrap"><span class="text-green-600">₱</span> <?= number_format($addons['sale']) ?></td>
                            <td class="whitespace-nowrap"><?= date('F j, Y', strtotime($addons['create_at'])) ?></td>
                            <td class="whitespace-nowrap"><?= date('F j, Y', strtotime($addons['update_at'])) ?></td>
                            <td class="whitespace-nowrap">
                                <a href="#" data-modal-toggle="in-modal" data-row-data="<?= $addons['product_id'] ?>" class="in flex bg-gradient-to-r from-gray-500 to-gray-700 text-gray-50 hover:text-gray-200 font-medium text-sm px-3 py-1 text-center inline-flex items-center border border-gray-500 hover:border-gray-100">
                                    IN
                                </a>
                                <a href="#" data-modal-toggle="out-modal" data-row-data="<?=$addons['product_id'] ?>" class="out flex bg-gradient-to-r from-gray-500 to-gray-700 text-gray-50 hover:text-gray-200 font-medium text-sm px-3 py-1 text-center inline-flex items-center border border-gray-500 hover:border-gray-100">
                                    OUT
                                </a>
                                <a href="#" data-row-data="<?= $addons['product_id'] ?>" class="modal-open update-product flex bg-gradient-to-r from-gray-500 to-gray-700 text-gray-50 hover:text-gray-200 font-medium text-sm px-3 py-1 text-center inline-flex items-center border border-gray-500 hover:border-gray-100">
                                    EDIT
                                </a>
                            </td>
                            <td>
                                <?php
                                $ing = array_filter(explode(", ", $addons['description']));

                                for ($i = 0; $i < count($ing); $i++) {
                                    echo "<span class='bg-gray-200 capitalize rounded-md m-1 px-1 font-semibold text-gray-700'>" . $ing[$i] . "</span>";
                                }
                                ?>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            <?php } else if (urlIs('p=other')) { ?>
                <tbody>
                    <?php
                    foreach ($menu->products_menu('other') as $other) { ?>
                        <tr>
                            <td><?= $id++ ?></td>
                            <td class="text-center">
                            <input type="checkbox" data-row-data="<?= $other['product_id'] ?>" id="" class="select" value="<?= $other['product_id'] ?>">
                            </td>
                            <td class="flex ml-4">
                                <img src="public/storage/uploads/<?= $other['picture'] !== Null ? $other['picture'] : 'default.jpg' ?>" alt="Product image" class="h-10 w-10 rounded-full">
                                <p class="pt-2 ml-2 capitalize"><?= $other['name'] ?></p>
                            </td>
                            <td class="text-center">
                                <select data-row-data="<?= $other['product_id'] ?>" class="status-product">
                                    <option value="" selected hidden><?= $other['status'] !== '' ? $other['status'] : 'Status' ?></option>
                                    <option value="Available">Available</option>
                                    <option value="Unavailable">Unavailable</option>
                                </select>
                            </td>
                            <td><span class="text-green-600">₱</span> <?= $other['price'] ?></td>
                            <td class="<?= $other['quantity'] <= $other['reorder_level'] ? 'text-red-500' : '' ?>"><?= $other['quantity'] ?></td>
                            <td><input type="text" value="<?= $other['reorder_level'] ?>" data-row-data="<?= $other['product_id'] ?>" class="reorder myInput bg-gray-50 w-20 border border-gray-300 text-gray-900 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block px-2 py-1 text-center"></td>
                            <td class="whitespace-nowrap"><span class="text-green-600">₱</span> <?= number_format($other['total']) ?></td>
                            <td class="whitespace-nowrap"><span class="text-green-600">₱</span> <?= number_format($other['sale']) ?></td>
                            <td class="whitespace-nowrap"><?= date('F j, Y', strtotime($other['create_at'])) ?></td>
                            <td class="whitespace-nowrap"><?= date('F j, Y', strtotime($other['update_at'])) ?></td>
                            <td class="whitespace-nowrap">
                                <a href="#" data-modal-toggle="in-modal" data-row-data="<?= $other['product_id'] ?>" class="in flex bg-gradient-to-r from-gray-500 to-gray-700 text-gray-50 hover:text-gray-200 font-medium text-sm px-3 py-1 text-center inline-flex items-center border border-gray-500 hover:border-gray-100">
                                    IN
                                </a>
                                <a href="#" data-modal-toggle="out-modal" data-row-data="<?= $other['product_id'] ?>" class="out flex bg-gradient-to-r from-gray-500 to-gray-700 text-gray-50 hover:text-gray-200 font-medium text-sm px-3 py-1 text-center inline-flex items-center border border-gray-500 hover:border-gray-100">
                                    OUT
                                </a>
                                <a href="#" data-row-data="<?= $other['product_id'] ?>" class="modal-open update-product flex bg-gradient-to-r from-gray-500 to-gray-700 text-gray-50 hover:text-gray-200 font-medium text-sm px-3 py-1 text-center inline-flex items-center border border-gray-500 hover:border-gray-100">
                                    EDIT
                                </a>
                            </td>
                            <td>
                                <?php
                                $ing = array_filter(explode(", ", $other['description']));

                                for ($i = 0; $i < count($ing); $i++) {
                                    echo "<span class='bg-gray-200 capitalize rounded-md m-1 px-1 font-semibold text-gray-700'>" . $ing[$i] . "</span>";
                                }
                                ?>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            <?php } ?>
        </table>

    </div>
</section>

<?php 
require(view('components/in-modal'));
require(view('components/out-modal'));
require(view('components/form-product'));
?>

<script type="text/javascript">
    $(function() {
        $('#category-table').DataTable({
            initComplete: function () {
                $('#historytbl_filter input').attr('maxlength', 35);
            },
            "paging": false,
            responsive: true,
            columns: [
                { title: '#' },
                { title: '<input type="checkbox" name="" id="selectAll">' },
                { title: 'NAME' },
                { title: 'STATUS' },
                { title: 'PRICE' },
                { title: 'ON HAND' },
                { title: 'REORDER LEVEL' },
                { title: 'TOTAL' },
                { title: 'SALE' },
                { title: 'CREATED' },
                { title: 'UPDATED' },
                { title: 'ACTION' },
                { title: 'DESCRIPTION' }
            ],
        }).columns.adjust().responsive.recalc();

        $('#selectAll').click(function() {
            $('.select').not(this).prop('checked', this.checked);
        });

        $('.status-product').change(function() {
            var id = $(this).data("rowData");
            var status = $(this).val();
            $.ajax({
                url: 'index.php?a=status_product',
                type: 'POST',
                data: {
                    status: status,
                    id: id
                },
                dataType: 'json',
                success: function(resp) {
                    swal({
                        icon: 'success',
                        text: resp.msg,
                        buttons: false,
                        timer: 1000
                    })
                }
            });
        });

        $('.reorder').on('keyup', function() {
            $.ajax({
                url: 'index.php?a=reorder_product',
                type: 'POST',
                data: {
                    product_id: $(this).data('row-data'),
                    reorder: $(this).val()
                }
            });
        });

        $('.in').click(function() {
            var data = $(this).data('row-data');
            $('#in_product_id').val(data);
        });

        $('.out').click(function() {
            var data = $(this).data('row-data');
            $('#out_product_id').val(data);
        });

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

        $('.add-product').click(function() {
            $('#product').val('');
            $('#price').val('');
            $('#price').val('');
            $('#description').val('');
            $('.savebtn').removeClass('hidden');
            $('.updatebtn').addClass('hidden');
            $("#img-con").attr("src", "public/storage/eximage/icon.jpg");
            $('#title-form').html('Add Product');
        });

        $('.update-product').click(function() {
            $('#title-form').html('Update Product');
            $('.savebtn').addClass('hidden');
            $('.updatebtn').removeClass('hidden');
            $.ajax({
                url: 'index.php?a=data_product',
                type: 'POST',
                dataType: 'json',
                data: {
                    id: $(this).data('row-data')
                },
                success: function(data) {
                    $('#product').val(data.name);
                    $('#price').val(data.price);
                    $('#id').val(data.product_id);
                    $('#category').val(data.category);
                    $('#description').val(data.description);
                    if (data.picture !== null) {
                        $("#img-con").attr("src", "public/storage/uploads/" + data.picture + "");
                    } else {
                        $("#img-con").attr("src", "public/storage/uploads/default.jpg");
                    }
                }
            });
        });

        $('.status-product').change(function() {
            var id = $(this).data("rowData");
            var status = $(this).val();
            $.ajax({
                url: 'index.php?a=status_product',
                type: 'POST',
                data: {
                    status: status,
                    id: id
                },
                dataType: 'json',
                success: function(resp) {
                    swal({
                        icon: 'success',
                        text: resp.msg,
                        buttons: false,
                        timer: 1000
                    })
                }
            });
        });

        // Reset sale
        $('.reset-sale').click(function(e) {
            e.preventDefault();
            $(this).addClass('animate-spin');
            swal({
                title: "This action cannot be undone",
                text: "Are you sure you want to proceed with resetting the sale?",
                icon: "warning",
                buttons: ["No", "Yes"],
                dangerMode: true,
            }).then((willDone) => {
                if (willDone) {
                    $.ajax({
                        url: 'index.php?a=reset_sale',
                        dataType: 'json',
                        success: function(resp) {
                            if (resp.status == 'success') {
                                swal({
                                    icon: 'success',
                                    text: 'Sale reset',
                                    buttons: false,
                                    timer: 1000
                                }).then(() => location.reload());
                            }
                        }
                    });
                }
                $(this).removeClass('animate-spin');
            });
        });

        $('#delete-row').click(function() {
            swal({
                title: "Are you sure you want to delete this row(s)?",
                text: "This action cannot be undone.",
                icon: "warning",
                buttons: ["No", "Yes"],
                dangerMode: true,
            }).then((willDone) => {
                if (willDone) {
                    var checkboxes = $('.select');
                    var rowData = [];
                    checkboxes.each(function() {
                        if ($(this).is(':checked')) {
                            var data = $(this).data('row-data');
                            rowData.push(data);
                        }
                    });

                    $.ajax({
                        url: 'index.php?a=delete_row',
                        type: 'POST',
                        data: {
                            'data': rowData
                        },
                        dataType: 'json',
                        success: function(resp) {
                            if (resp.status == 'success') {
                                swal({
                                    text: resp.msg,
                                    icon: "success",
                                    buttons: false,
                                    timer: 2000,
                                }).then(() => {
                                    location.reload()
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
                }
            });
        });

        $('#exportpdf').click(function() {
            var checkboxes = $('.select');
            var rowData = [];
            checkboxes.each(function() {
                if ($(this).is(':checked')) {
                    var data = $(this).data('row-data');
                    rowData.push(data);
                }
            });
            $.ajax({
                url: 'index.php?a=product_report',
                type: 'POST',
                data: {
                    'product_ids': rowData
                },
                dataType: 'json',
                success: function(resp) {
                    if (resp.status = 'success') {
                        var newWindow = window.open('inventory-report.php');

                        $(newWindow).on('load', function() {
                            newWindow.print();
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

        // Modal
        var openmodal = document.querySelectorAll('.modal-open')
        for (var i = 0; i < openmodal.length; i++) {
            openmodal[i].addEventListener('click', function(event) {
                event.preventDefault()
                toggleModal()
            })
        }

        const overlay = document.querySelector('.modal-overlay')
        overlay.addEventListener('click', toggleModal)

        var closemodal = document.querySelectorAll('.modal-close')
        for (var i = 0; i < closemodal.length; i++) {
            closemodal[i].addEventListener('click', toggleModal)
        }

        document.onkeydown = function(evt) {
            evt = evt || window.event
            var isEscape = false
            if ("key" in evt) {
                isEscape = (evt.key === "Escape" || evt.key === "Esc")
            } else {
                isEscape = (evt.keyCode === 27)
            }
            if (isEscape && document.body.classList.contains('modal-active')) {
                toggleModal()
            }
        };

        function toggleModal() {
            const body = document.querySelector('body')
            const modal = document.querySelector('.modal')
            modal.classList.toggle('opacity-0')
            modal.classList.toggle('pointer-events-none')
            body.classList.toggle('modal-active')
        }
    });
</script>

<?php } else { ?>
    <div class="flex justify-center items-center">
        <h1 class="mt-20 text-2xl font-bold text-gray-500">Unauthorized User</h1>
    </div>
<?php } ?>