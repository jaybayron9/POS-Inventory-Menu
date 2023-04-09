<?php if (Auth::isAdmin()) { ?>

    <link rel="stylesheet" href="public/assets/css/table.css">
    <?php require(view('components/form-item')) ?>
    <?php require(view('components/speed-dial')) ?>
    <?php require(view('components/form-item-update')) ?>
    <section class="container mx-auto p-5">
        <div class="bg-gray-50 p-4 rounded-md shadow-md m-5" style="background-image: url('public/storage/eximage/bg3.png'); background-size: 20px 20px; background-repeat: repeat;">
            <table id="inventorytbl" class="stripe hover" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
                <thead>
                    <tr>
                        <th data-priority="1">ItemID</th>
                        <th data-priority="2"><input type="checkbox" name="item_id" id="checkAll" class=""></th>
                        <th data-priority="3">ItemName</th>
                        <th data-priority="11">Description</th>
                        <th data-priority="5">Quantity</th>
                        <th data-priority="6">UnitCost</th>
                        <th data-priority="7">TotalValue</th>
                        <th data-priority="8">ReorderLevel</th>
                        <th data-priority="9">Supplier</th>
                        <th data-priority="10">Location</th>
                        <th data-priority="11">UpdatedAt</th>
                        <th data-priority="4">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    foreach ($inv->inventorytbl() as $item) {
                    ?>
                        <tr>
                            <td class="text-left"><?= $i++ ?></td>
                            <td class="text-center">
                                <input type="checkbox" data-row-data="<?= $item['id'] ?>" class="deleteCheckbox">
                            </td>
                            <td class="text-left capitalize"><?= $item['item_name'] ?></td>
                            <td class="text-left capitalize"><?= $item['description'] ?></td>
                            <td class="text-left"><?= $item['quantity'] ?></td>
                            <td class="text-left"><?= $item['unit_cost'] ?></td>
                            <td class="text-left"><?= $item['total_value'] ?></td>
                            <td class="text-left"><?= $item['reorder_level'] ?></td>
                            <td class="text-left capitalize"><?= $item['supplier'] ?></td>
                            <td class="text-left capitalize"><?= $item['location'] ?></td>
                            <td class="text-left">
                                <?php
                                    $dateTime = new DateTime($item['updated_at']);
                                    echo $dateTime->format('F j, Y g:i A');
                                ?>
                                </td>
                            <td class="text-center">
                                <button type="button" data-row-data="<?= $item['id'] ?>" data-modal-toggle="update-item-modal" class="update bg-gradient-to-r from-blue-400 to-gray-700 text-white hover:text-gray-200 px-2 rounded">Edit</button>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </section>

    <script>
        $(document).ready(function() {
            $('#inventorytbl').DataTable({
                    "paging": false,
                    responsive: true
                })
                .columns.adjust()
                .responsive.recalc();

            $('#checkAll').click(function() {
                $('input:checkbox').not(this).prop('checked', this.checked);
            });

            $('input[type="checkbox"]').change(function() {
                if (!this.checked) {
                    $('#checkAll').prop('checked', false);
                }
            });

            $('.update').click(function() {
                let itemId = $(this).data('row-data');

                $.ajax({
                    url: 'index.php?i=get_item',
                    type: 'POST',
                    data: {
                        itemId: itemId
                    },
                    dataType: 'json',
                    success: function(data) {
                        $('#upId').val(data.id);
                        $('#upItemName').val(data.item_name);
                        $('#upQuantity').val(data.quantity);
                        $('#upUnitCost').val(data.unit_cost);
                        $('#upTotalValue').val(data.total_value);
                        $('#upSupplier').val(data.supplier);
                        $('#upLocation').val(data.location);
                        $('#upReorderLevel').val(data.reorder_level);
                        $('#upDescription').val(data.description);
                    }
                });
            });

            $('#deleteSelectedRows').click(function(e) {
                e.preventDefault();

                var checkboxes = $('.deleteCheckbox');
                var rowData = [];
                checkboxes.each(function() {
                    if ($(this).is(':checked')) {
                        var data = $(this).data('row-data');
                        rowData.push(data);
                    }
                });
 
                $.ajax({
                    type: "POST",
                    url: "index.php?i=delete_rows",
                    data: {
                        ids: rowData
                    },
                    dataType: 'json',
                    success: function(resp) {
                        if (resp.status == 'success') {
                            swal({
                                title: "Success!",
                                text: resp.msg,
                                icon: resp.status,
                                buttons: false,
                                timer: 2000,
                            }).then(function() {
                                location.reload();
                            })
                        } else {
                            swal({
                                text:resp.msg,
                                icon:resp.status,
                                buttons:false,
                                timer:2000}).then(function(){
                                    location.reload();
                            });
                        }
                    }
                });
            });
        });
    </script>

<?php } else { ?>
    <div class="flex justify-center items-center">
        <h1 class="mt-20 text-2xl font-bold text-gray-500">Unauthorized User</h1>
    </div>
<?php } ?>