<?php if (Auth::isAdmin()) { ?>

    <link rel="stylesheet" href="public/assets/css/table.css">
    <?php require(view('components/form-item')) ?>
    <?php require(view('components/speed-dial')) ?>
    <?php require(view('components/form-item-update')) ?>
    <section class="container mx-auto p-5">
        <div class="bg-gray-50 p-4 rounded-md shadow-md m-5">
            <table id="inventorytbl" class="stripe hover" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
                <thead>
                    <tr>
                        <th data-priority="1"><input type="checkbox" name="item_id" id="checkAll" class=""></th>
                        <th data-priority="5">ItemID</th>
                        <th data-priority="2">ItemName</th>
                        <th data-priority="5">Quantity</th>
                        <th data-priority="6">Unit</th>
                        <th data-priority="7">UnitPrice</th>
                        <th data-priority="8">TotalValue</th>
                        <th data-priority="9">LeadTime</th>
                        <th data-priority="4">ReorderPoints</th>
                        <th data-priority="15">SafetyStock</th>
                        <th data-priority="11">DemandVariability</th>
                        <th data-priority="12">Description</th>
                        <th data-priority="13">Supplier</th>
                        <th data-priority="14">Location</th>
                        <th data-priority="3">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    foreach ($inv->inventorytbl() as $item) {
                    ?>
                        <tr>
                            <td class="text-center">
                                <input type="checkbox" data-row-data="<?= $item['ItemID'] ?>" class="deleteCheckbox">
                            </td>
                            <td class="text-left"><?= $item['ItemID'] ?></td>
                            <td class="text-left"><?= $item['ItemName'] ?></td>
                            <td class="text-left"><?= $item['Quantity'] ?></td>
                            <td class="text-left"><?= $item['Unit'] ?></td>
                            <td class="text-left"><?= $item['UnitPrice'] ?></td>
                            <td class="text-left"><?= $item['TotalValue'] ?></td>
                            <td class="text-left"><?= $item['LeadTime'] ?></td>
                            <td class="text-left text-red-500"><?php //$item['ReorderPoints'] 
                                                                ?></td>
                            <td class="text-left"><?= $item['SafetyStock'] ?></td>
                            <td class="text-left"><?= $item['DemandVariability'] ?></td>
                            <td class="text-left"><?= $item['Description'] ?></td>
                            <td class="text-left"><?= $item['Supplier'] ?></td>
                            <td class="text-left"><?= $item['Location'] ?></td>
                            <td class="text-center">
                                <button type="button" data-row-data="<?= $item['ItemID'] ?>" data-modal-toggle="update-item-modal" class="update bg-gradient-to-r from-blue-400 to-gray-700 text-white hover:text-gray-200 px-2 rounded">Edit</button>
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
                        $('#upId').val(data.ItemID);
                        $('#upItemName').val(data.ItemName);
                        $('#upQuantity').val(data.Quantity);
                        $('#upUnit').val(data.Unit);
                        $('#upUnitPrice').val(data.UnitPrice);
                        $('#upTotalPrice').val(data.TotalValue);
                        $('#upSupplier').val(data.Supplier);
                        $('#upLocation').val(data.Location);
                        $('#upDescription').val(data.Description);
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
                            location.reload();
                        } else {
                            alert(resp.msg);
                        }
                    }
                });
            });
        });
    </script>

<?php } else {
?>
    <div class="flex justify-center items-center">
        <h1 class="mt-20 text-2xl font-bold text-gray-500">Unauthorized User</h1>
    </div>
<?php
} ?>