<link rel="stylesheet" href="public/assets/css/table.css">
<section class="container mx-auto p-5">
    <div class="bg-gray-50 p-4 rounded shadow-md mb-5" style="background-image: url('public/storage/eximage/bg3.png'); background-size: 20px 20px; background-repeat: repeat;">
        <div class="flex flex-wrap justify-center items-center mb-3">
            <p class="font-light text-gray-700 capitalize"><?= $menu->total_product_sale()['name'] ?> <span class="text-green-500"> &#8369; </span></p>
            <span class="font-semibold text-gray-800">
                <?php
                echo '&nbsp;' . number_format($menu->total_product_sale()['sale'], 2);
                ?>
            </span>
            <div class="ml-auto mr-3">
                <button id="dropdownHoverButton" data-dropdown-toggle="dropdownHover" data-dropdown-trigger="hover" class="
            rounded-md flex bg-gradient-to-r from-red-500 to-gray-700 text-white hover:text-red-200 font-medium text-sm px-3 py-1 text-center inline-flex items-center border border-gray-500 hover:border-rose-400" type="button">
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
                    }
                    ?>
                    <svg class="w-4 h-4 ml-2" aria-hidden="true" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
                <!-- Dropdown menu -->
                <div id="dropdownHover" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 bg-gray-100">
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
                    </ul>
                </div>
            </div>
            <div class="mr-3">
                <a href="#" title="Add Product" class="modal-open add-product rounded-md flex bg-gradient-to-r from-red-500 to-gray-700 text-white hover:text-red-200 font-medium text-sm px-4 text-center inline-flex items-center border border-gray-500 hover:border-rose-400" style="padding: 2px 7px 2px 7px;">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>Add
                </a>
            </div>
            <?php require(view('components/form-product')) ?>
            <a href="#" title="Reset Sale" class="reset-sale bg-gradient-to-r p-1 px-1 from-red-500 to-gray-700 text-white hover:text-red-200 rounded-full border border-gray-500 hover:border-rose-400">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
                </svg>
            </a>
        </div>

        <?php if (urlIs('p=meals') || urlIs('p=product')) { ?>
            <div id="meals" class="">
                <table id="mealstbl" class="stripe hover" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
                    <thead>
                        <tr>
                            <th data-priority="1">Name</th>
                            <th data-priority="3">Price</th>
                            <th data-priority="4">Status</th>
                            <th data-priority="6">Description</th>
                            <th data-priority="5">Sale</th>
                            <th data-priority="7">Created</th>
                            <th data-priority="8">Updated</th>
                            <th data-priority="2">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($menu->products_menu('meals') as $productmeals) { ?>
                            <tr>
                                <td class="flex ml-4">
                                    <img src="public/storage/uploads/<?= $productmeals['picture'] !== Null ? $productmeals['picture'] : 'default.jpg' ?>" alt="Product image" class="h-10 w-10 rounded-full">
                                    <p class="pt-2 ml-2 capitalize"><?= $productmeals['name'] ?></p>
                                </td>
                                <td><span class="text-green-600">₱</span> <?= $productmeals['price'] ?></td>
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
                                <td><span class="text-green-600">₱</span> <?= number_format($productmeals['sale'], 2) ?></td>
                                <td><?= date('F j, Y \a\t g:i:s A', strtotime($productmeals['create_at'])) ?></td>
                                <td><?= date('F j, Y \a\t g:i:s A', strtotime($productmeals['update_at'])) ?></td>
                                <td class="text-center">
                                    <a href="#" title="Update product" data-row-data="<?= $productmeals['product_id'] ?>" class="modal-open update-product bg-gradient-to-r from-blue-400 to-gray-700 text-white hover:text-gray-200 px-2 rounded">Edit</a>
                                    <a href="#" title="Delete product" data-row-data="<?= $productmeals['product_id'] ?>" class="delete-productbtn bg-gradient-to-r from-red-400 to-red-700 text-white hover:text-gray-200 px-2 rounded">Delete</a>
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
                            <th data-priority="1">Product Name</th>
                            <th data-priority="3">Sales Price</th>
                            <th data-priority="4">Status</th>
                            <th data-priority="6">Description</th>
                            <th data-priority="5">Sale</th>
                            <th data-priority="7">Created</th>
                            <th data-priority="8">Updated</th>
                            <th data-priority="2">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($menu->products_menu('drinks') as $productdrinks) { ?>
                            <tr>
                                <td class="flex ml-4">
                                    <img src="public/storage/uploads/<?= $productdrinks['picture'] !== Null ? $productdrinks['picture'] : 'default.jpg' ?>" alt="Product image" class="h-14 w-14 rounded-full">
                                    <p class="pt-4 ml-3 capitalize"><?= $productdrinks['name'] ?></p>
                                </td>
                                <td><span class="text-green-600">₱</span> <?= $productdrinks['price'] ?></td>
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
                                <td><?= date('F j, Y \a\t g:i:s A', strtotime($productdrinks['create_at'])) ?></td>
                                <td><?= date('F j, Y \a\t g:i:s A', strtotime($productdrinks['update_at'])) ?></td>
                                <td class="text-center">
                                    <a href="#" title="Update product" data-row-data="<?= $productdrinks['product_id'] ?>" class="modal-open update-product bg-gradient-to-r from-blue-400 to-gray-700 text-white hover:text-gray-200 px-2 rounded">Edit</a>
                                    <a href="#" title="Delete product" data-row-data="<?= $productdrinks['product_id'] ?>" class="delete-productbtn bg-gradient-to-r from-red-400 to-red-700 text-white hover:text-gray-200 px-2 rounded">Delete</a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        <?php } else if (urlIs('p=add-ons')) { ?>
            <div id="drinks">
                <table id="addonstbl" class="stripe hover" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
                    <thead>
                        <tr>
                            <th data-priority="1">Product Name</th>
                            <th data-priority="3">Sales Price</th>
                            <th data-priority="4">Status</th>
                            <th data-priority="6">Description</th>
                            <th data-priority="5">Sale</th>
                            <th data-priority="7">Created</th>
                            <th data-priority="8">Updated</th>
                            <th data-priority="2">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($menu->products_menu('add-ons') as $addons) { ?>
                            <tr>
                                <td class="flex ml-4">
                                    <img src="public/storage/uploads/<?= $addons['picture'] !== Null ? $addons['picture'] : 'default.jpg' ?>" alt="Product image" class="h-14 w-14 rounded-full">
                                    <p class="pt-4 ml-3 capitalize"><?= $addons['name'] ?></p>
                                </td>
                                <td><span class="text-green-600">₱</span> <?= $addons['price'] ?></td>
                                <td class="text-center">
                                    <select data-row-data="<?= $addons['product_id'] ?>" class="status-product">
                                        <option value="" selected hidden><?= $addons['status'] !== '' ? $addons['status'] : 'Status' ?></option>
                                        <option value="Available">Available</option>
                                        <option value="Unavailable">Unavailable</option>
                                    </select>
                                </td>
                                <td>
                                    <?php
                                    $ing = array_filter(explode(", ", $addons['description']));

                                    for ($i = 0; $i < count($ing); $i++) {
                                        echo "<span class='bg-gray-200 rounded-md m-1 px-1 font-semibold text-gray-700'>" . $ing[$i] . "</span>";
                                    }
                                    ?>
                                </td>
                                <td><span class="text-green-600">₱</span> <?= number_format($addons['sale'], 2) ?></td>
                                <td><?= date('F j, Y \a\t g:i:s A', strtotime($addons['create_at'])) ?></td>
                                <td><?= date('F j, Y \a\t g:i:s A', strtotime($addons['update_at'])) ?></td>
                                <td class="text-center">
                                    <a href="#" title="Update product" data-row-data="<?= $addons['product_id'] ?>" class="modal-open update-product bg-gradient-to-r from-blue-400 to-gray-700 text-white hover:text-gray-200 px-2 rounded">Edit</a>
                                    <a href="#" title="Delete product" data-row-data="<?= $addons['product_id'] ?>" class="delete-productbtn bg-gradient-to-r from-red-400 to-red-700 text-white hover:text-gray-200 px-2 rounded">Delete</a>
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
            .columns.adjust()
            .responsive.recalc();

        $('#drinkstbl').DataTable({
                "paging": false,
                responsive: true
            })
            .columns.adjust()
            .responsive.recalc();

        $('#addonstbl').DataTable({
                "paging": false,
                responsive: true
            })
            .columns.adjust()
            .responsive.recalc();

        $('.delete-productbtn').click(function() {
            swal({
                    title: "You want to delete this product?",
                    icon: "warning",
                    buttons: ["No", "Yes"],
                })
                .then((willDone) => {
                    if (willDone) {
                        $.ajax({
                            url: 'index.php?a=delete_product',
                            type: 'POST',
                            data: {
                                id: $(this).data('row-data')
                            },
                            dataType: 'json',
                            error: function(xhr, status, error) {
                                swal({
                                    icon: 'success',
                                    text: 'Product deleted',
                                    buttons: false,
                                    timer: 1000
                                })
                                setTimeout(function() {
                                    location.reload();
                                }, 1200);
                            }
                        });
                    } else {
                        swal({
                            icon: 'success',
                            text: 'Product safe',
                            buttons: false,
                            timer: 1000
                        })
                    }
                });
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
                    title: "Are you sure you want to reset sale?",
                    icon: "warning",
                    buttons: ["No", "Yes"],
                })
                .then((willDone) => {
                    if (willDone) {
                        $.ajax({
                            url: 'index.php?a=reset_sale',
                            dataType: 'json',
                            success: function(resp) {
                                if (resp.status == 'success') {
                                    $(this).removeClass('animate-spin');
                                    swal({
                                        icon: 'success',
                                        text: 'Sale reset',
                                        buttons: false,
                                        timer: 1000
                                    })
                                    setTimeout(function() {
                                        location.reload();
                                    }, 1200);
                                } else {
                                    $(this).removeClass('animate-spin');
                                    swal({
                                        icon: 'error',
                                        text: 'Something went wrong',
                                        buttons: false,
                                        timer: 1000
                                    })
                                }
                            }
                        });
                    } else {
                        $(this).removeClass('animate-spin');
                        swal({
                            icon: 'success',
                            text: 'Sale safe',
                            buttons: false,
                            timer: 1000
                        })
                    }
                });
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