<div class="flex items-center justify-center min-h-screen">
    <div  class="px-8 py-6 mt-4 text-left bg-gray-100 shadow-md rounded-md" style="background-image: url('public/storage/eximage/bg3.png'); background-size: 35px 35px;">
        <h3 class="text-2xl font-extrabold text-center text-transparent bg-clip-text bg-gradient-to-r from-red-400 to-gray-900">Forgot your password?</h3>
        <form id="changepass-form">
            <div class="mt-4">
                <div>
                    <label class="block" for="new password">New Password<label>
                            <input type="password" name="newpass" placeholder="*********" maxlength="30"
                                class="border-gray-300 w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600" required>
                </div>
                <div class="mt-4">
                    <label class="block">Confirm Password<label>
                            <input type="password" name="conpass" autocomplete="off" maxlength="30" placeholder="*********"
                                class="border-gray-300 w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600" required>
                </div>
                <div class="flex items-baseline justify-between">
                    <a href="#" id="forgot" class="text-sm text-blue-600 hover:underline"></a>
                    <button type="submit" class="px-6 py-2 mt-5 font-medium rounded border rounded-md border-gray-500 hover:border-gray-50 rounded-md mt-2 bg-gradient-to-r from-red-500 to-gray-700 text-white hover:text-red-200">Change</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('#changepass-form').submit(function (e) {
            e.preventDefault();
            $.ajax({
                url: 'index.php?s=change_pass',
                type: 'POST',
                data: $(this).serialize(),
                dataType: 'json',
                success: function (data) {
                    if (data.status == 'success') {
                        swal({
                            text: data.msg,
                            icon: data.status,
                            buttons: false,
                            timer: 2000,
                        }).then(() => { window.location.href = 'index.php'; })
                    } else {
                        swal({
                            text: data.msg,
                            icon: data.status,
                            buttons: false,
                            timer: 2000,
                        })
                    }
                }
            });
        });
    });
</script>