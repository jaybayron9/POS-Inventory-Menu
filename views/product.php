<link rel="stylesheet" href="public/assets/css/table.css">
<section class="container mx-auto px-5">
    <div class="flex my-4">
        <p class="font-bold">TPS:
            <span class="font-semibold text-gray-50">
                <?php
                echo '&nbsp;&#8369;&nbsp;' . number_format($menu->total_product_sale(), 2);
                ?>
            </span>
        </p>
        <div class="ml-auto mr-3">
            <button id="dropdownHoverButton" data-dropdown-toggle="dropdownHover" data-dropdown-trigger="hover" class="
            rounded-md flex bg-gradient-to-r from-red-500 to-gray-700 text-white hover:text-red-200 font-medium text-sm px-3 py-1 text-center inline-flex items-center" type="button">
                <?php
                    switch (true) {
                            case urlIs('p=meals') || urlIs('p=product'):
                                echo 'Meals';
                                break;
                            case urlIs('p=drinks'):
                                echo 'Drinks';
                                break;
                        break;
                    }
                ?>
                <svg class="w-4 h-4 ml-2" aria-hidden="true" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg></button>
            <!-- Dropdown menu -->
            <div id="dropdownHover" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 bg-gray-100">
                <ul class="py-2 text-sm text-gray-700 text-gray-800" aria-labelledby="dropdownHoverButton">
                    <li>
                        <a href="?p=meals" id="mealsbtn" class="block px-4 py-2 hover:bg-gray-600 hover:text-white">Meals</a>
                    </li>
                    <li>
                        <a href="?p=drinks" id="drinksbtn" class="block px-4 py-2 hover:bg-gray-600 hover:text-white">Drinks</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="mr-4 hover:bg-gray-200 rounded-full">
            <a href="#" title="Add Product" class="modal-open add-product bg-gray-400 rounded-full">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
            </a>
        </div>
        <?php require(view('components/form-product')) ?>
        <div class="hover:bg-gray-200 rounded-full">
            <a href="#" title="Reset Sale" class="reset-sale ">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
                </svg>
            </a>
        </div>
    </div>
    <div class="bg-gray-50 px-4 py-4 rounded-lg shadow-md mb-5">
        <?php if (urlIs('p=meals') || urlIs('p=product')) { ?>
            <div id="meals" class="">
                <table id="mealstbl" class="stripe hover" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
                    <thead>
                        <tr>
                            <th data-priority="1">#</th>
                            <th data-priority="2">Name</th>
                            <th data-priority="4">Price</th>
                            <th data-priority="5">Status</th>
                            <th data-priority="7">Ingredients</th>
                            <th data-priority="6">Sale</th>
                            <th data-priority="3">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $index = 1;
                        foreach ($menu->products_menu('meals') as $productmeals) { ?>
                            <tr>
                                <td class="text-center"><?= $index++ ?></td>
                                <td class="flex">
                                    <img src="public/storage/uploads/<?= $productmeals['picture'] !== Null ? $productmeals['picture'] : 'default.jpg' ?>" alt="Product image" class="h-10 w-10 rounded-full">
                                    <p class="pt-2 ml-2 capitalize"><?= $productmeals['name'] ?></p>
                                </td>
                                <td class="text-center"><span class="text-green-600">₱</span> <?= $productmeals['price'] ?></td>
                                <td class="text-center">
                                    <select data-row-data="<?= $productmeals['product_id'] ?>" class="status-product">
                                        <option value="" selected hidden><?= $productmeals['status'] !== '' ? $productmeals['status'] : 'Status' ?></option>
                                        <option value="Available">Available</option>
                                        <option value="Unavailable">Unavailable</option>
                                    </select>
                                </td>
                                <td>
                                    <?php
                                    $ing = array_filter(explode(", ", $productmeals['description']));

                                    for ($i = 0; $i < count($ing); $i++) {
                                        echo "<span class='bg-gray-200 capitalize rounded-md m-1 px-1 font-semibold text-gray-700'>" . $ing[$i] . "</span>";
                                    }
                                    ?>
                                </td>
                                <td class="text-center"><span class="text-green-600">₱</span> <?= number_format($productmeals['sale'], 2) ?></td>
                                <td class="text-center">
                                    <a href="#" title="Update product" data-row-data="<?= $productmeals['product_id'] ?>" class="modal-open update-product bg-gradient-to-r from-blue-400 to-gray-700 text-white hover:text-gray-200 px-2 rounded">Edit</a>
                                    <a href="" title="Delete product" data-row-data="<?= $productmeals['product_id'] ?>" class="delete-productbtn bg-gradient-to-r from-red-400 to-red-700 text-white hover:text-gray-200 px-2 rounded">Del</a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        <?php } else if (urlIs('p=drinks')) { ?>
            <div id="drinks">
                <table id="mealstbl" class="stripe hover" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
                    <thead>
                        <tr>
                            <th data-priority="1">#</th>
                            <th data-priority="2">Product Name</th>
                            <th data-priority="4">Sales Price</th>
                            <th data-priority="5">Status</th>
                            <th data-priority="6">Description</th>
                            <th data-priority="6">Sale</th>
                            <th data-priority="3">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        foreach ($menu->products_menu('drinks') as $productdrinks) { ?>
                            <tr>
                                <td class="text-center"><?= $i++ ?></td>
                                <td class="flex">
                                    <img src="public/storage/uploads/<?= $productdrinks['picture'] !== Null ? $productdrinks['picture'] : 'default.jpg' ?>" alt="Product image" class="h-14 w-14 rounded-full">
                                    <p class="pt-4 ml-3"><?= $productdrinks['name'] ?></p>
                                </td>
                                <td class="text-center"><span class="text-green-600">₱</span> <?= $productdrinks['price'] ?></td>
                                <td class="text-center">
                                    <select data-row-data="<?= $productdrinks['product_id'] ?>" class="status-product">
                                        <option value="" selected hidden><?= $productdrinks['status'] !== '' ? $productdrinks['status'] : 'Status' ?></option>
                                        <option value="Available">Available</option>
                                        <option value="Unavailable">Unavailable</option>
                                    </select>
                                </td>
                                <td>
                                    <?php
                                    $ing = array_filter(explode(", ", $productdrinks['description']));

                                    for ($i = 0; $i < count($ing); $i++) {
                                        echo "<span class='bg-gray-200 rounded-md m-1 px-1 font-semibold text-gray-700'>" . $ing[$i] . "</span>";
                                    }
                                    ?>
                                </td>
                                <td><span class="text-green-600">₱</span> <?= number_format($productdrinks['sale'], 2) ?></td>
                                <td class="text-center">
                                    <a href="#" title="Update product" data-row-data="<?= $productdrinks['product_id'] ?>" class="modal-open update-product bg-gradient-to-r from-blue-400 to-gray-700 text-white hover:text-gray-200 px-2 rounded">Edit</a>
                                    <a href="" title="Delete product" data-row-data="<?= $productdrinks['product_id'] ?>" class="delete-productbtn bg-gradient-to-r from-red-400 to-red-700 text-white hover:text-gray-200 px-2 rounded">Del</a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        <?php } ?>
    </div>
</section>

<script>
    $(document).ready(function() {
        $('#mealstbl').DataTable({
            "paging": false,
            responsive: true
        })
        $('#drinkstbl').DataTable({
                responsive: true
            })
            .columns.adjust()
            .responsive.recalc();

        $('.delete-productbtn').click(function() {
            if (!confirm('Are you sure you want to delete this product?')) {
                return false;
            } else {
                $.ajax({
                    url: 'index.php?a=delete_product',
                    type: 'POST',
                    data: {
                        id: $(this).data('row-data')
                    },
                    dataType: 'json',
                    success: function(resp) {
                        if (resp.status == 'success') {
                            location.reload();
                        }
                    }
                });
            }
        });

        $('.add-product').click(function() {
            $('#product').val('');
            $('#price').val('');
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
                success: function(data) {
                    console.log(data);
                }
            });
        });

        // Reset sale
        $('.reset-sale').click(function(e) {
            e.preventDefault();
            if (!confirm('Are you sure you want to reset sale?')) {
                return false;
            } else {
                $.ajax({
                    url: 'index.php?a=reset_sale',
                    dataType: 'json',
                    success: function(resp) {
                        if (resp.status == 'success') {
                            location.reload(true);
                        }
                    }
                });
            }
        });
    })

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
</script>