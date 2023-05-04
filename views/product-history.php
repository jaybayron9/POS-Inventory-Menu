<link rel="stylesheet" href="public/assets/css/table.css">

<section class="container mx-auto">
    <div class="bg-white p-4 rounded shadow-md mb-5 mt-5">
        <div class="flex flex-wrap gap-4 mb-8">
            <div class="flex border border-gray-200 pl-2 rounded h-7">
                <label for="search_date" class="block mt-1 font-medium">DATE :&nbsp;</label>
                <input type="date" id="search_date" name="date" class="border-none p-1">
            </div>
            <select id="in-out" class="px-2 rounded bg-gray-100 h-7">
                <option value="all">All</option>
                <option value="in">In</option>
                <option value="out">Out</option>
            </select>

            <a href="#" id="delete-row" title="Delete row" class="ml-auto bg-gradient-to-r p-1 px-1 from-red-500 to-gray-700 text-white hover:text-red-200 rounded-full border border-gray-500 hover:border-rose-400">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                </svg>
            </a>
        </div>
        <table id="historytbl" class="stripe hover" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
            <thead>
                    <tr>
                        <th data-priority="1" class="text-xs">#</th>
                        <th data-priority="2" class="text-xs"></th>
                        <th data-priority="3" class="text-xs">PID.</th>
                        <th data-priority="4" class="text-xs">PRODUCT NAME</th>
                        <th data-priority="5" class="text-xs">TYPE</th>
                        <th data-priority="6" class="text-xs">IN_OUT COUNT</th>
                        <th data-priority="7" class="text-xs">UPDATED QTY</th>
                        <th data-priority="7" class="text-xs">TOTAL</th>
                        <th data-priority="8" class="text-xs">DATE MODIFIED</th>
                    </tr>
            </thead>
            <tbody>
                <?php $i = 1; foreach( $menu->product_history() as $row ) { ?>
                <tr class="text-center <?= $row['type'] == 'OUT' ? 'text-red-500' : 'text-blue-500' ?>">
                    <td><?= $i++ ?></td>
                    <td class="text-center"><input type="checkbox" data-row-data="<?= $row['id'] ?>" id="" class="select " value="<?= $row['id'] ?>"></td>
                    <td><?= $row['product_id'] ?></td>
                    <td><?= $row['type'] ?></td>
                    <td><?= $row['product_name'] ?></td>
                    <td><?= $row['transaction_count'] ?></td>
                    <td><?= $row['updated_quantity'] ?></td>
                    <td><?= number_format($row['total']) ?></td>
                    <td><?= date('Y-m-d', strtotime($row['created_at'])) ?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</section>

<script type="text/javascript">
    $(function() {
        var table = $('#historytbl').DataTable({
                "lengthMenu": [10, 25, 50, 100, 200, 500, 1000, 2000, 5000],
                "paging": true,
                responsive: true,
                "initComplete": function () {
                    $('div.dataTables_filter input').attr('maxlength', 30);
                },
                columns: [
                    { title: '#' },
                    { title: '<input type="checkbox" name="" id="selectAll">' },
                    { title: 'PID.' },
                    { title: 'TYPE' },
                    { title: 'PRODUCT NAME' },
                    { title: 'IN_OUT COUNT' },
                    { title: 'UPDATED QTY' },
                    { title: 'TOTAL' },
                    { title: 'DATE MODIFIED' },
                ]
            })
            .columns.adjust()
            .responsive.recalc();

            
        $.fn.dataTable.ext.search.push(
            function(settings, data, dataIndex) {
                var searchDate = $('#search_date').val();
                var date = data[8]; // assuming the date is in the first column
                if (searchDate === '') {
                    return true;
                }
                if (date === searchDate) {
                    return true;
                }
                return false;
            }
        );

        $('#selectAll').click(function() {
            $('.select').not(this).prop('checked', this.checked);
        });
            
        $('#search_date').on('change', function() {
            table.draw();
        });

        $('#in-out').on('change', function() {
            var selectedValue = $(this).val();

            if (selectedValue === 'all') {
                table.column(3).search('').draw();
            } else if (selectedValue === 'in') {
                table.column(3).search('in').draw();
            } else if (selectedValue === 'out') {
                table.column(3).search('out').draw();
            }
        });

        $('#delete-row').click(function() {
            var checkboxes = $('.select');
            var rowData = [];
            checkboxes.each(function() {
                if ($(this).is(':checked')) {
                    var data = $(this).data('row-data');
                    rowData.push(data);
                }
            });

            swal({
                title: "Are you sure you want to delete this row(s)?",
                text: "This action cannot be undone.",
                icon: "warning",
                buttons: ["No", "Yes"],
                dangerMode: true,
            }).then((willDone) => {
                if (willDone) {
                    $.ajax({
                        url: 'index.php?a=delete_row_his',
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
    });
</script>