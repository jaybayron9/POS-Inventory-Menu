<?php if (Auth::isAdmin()) { ?>

    <link rel="stylesheet" href="public/assets/css/table.css">

    <?php require(view('components/user/speed-dial')) ?>
    <?php require(view('components/user/form-user')) ?>

    <section class="container mx-auto md:p-10 p-5">
        <div class="bg-gray-50 p-4 rounded shadow-md mb-5">
            <table id="userstbl" class="stripe hover" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
                <thead>
                    <tr>
                        <th class="text-xs"><input type="checkbox" name="" id="checkAll"></th>
                        <th class="text-xs">#</th>
                        <th class="text-xs">NAME</th>
                        <th class="text-xs">POSITION</th>
                        <th class="text-xs">CREATED</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    foreach (Auth::users() as $user) {
                    ?>
                        <tr>
                            <td class="text-center"><input type="checkbox" data-row-data="<?= $user['user_id'] ?>" name="" id="" class="deleteCheckbox"></td>
                            <td class="text-center"><?= $i++ ?></td>
                            <td class="text-center"><?= $user['username'] ?></td>
                            <td class="text-center"><?= $user['role'] ?></td>
                            <td class="text-center"><?= date('F j, Y \a\t g:i A', strtotime($user['created_at'])) ?></td>
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
            $('#userstbl').DataTable({
                    "paging": true,
                    responsive: true,
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

                if (rowData.length == 0) {
                    swal("No rows selected", "Please select at least one row to delete", "warning");
                    return;
                }

                swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this user!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            type: "POST",
                            url: "index.php?s=delete_users",
                            data: {
                                ids: rowData
                            },
                            success: function(resp) {
                                swal("Success", "Selected rows have been deleted", "success")
                                    .then(() => {
                                        location.reload(true);
                                    });
                            }
                        });
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