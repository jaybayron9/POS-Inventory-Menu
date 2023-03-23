<div class="flex items-center justify-center min-h-screen">
    <div  class="px-8 py-6 mt-4 text-left bg-white shadow-lg rounded-md">
        <h3 class="text-2xl font-bold text-center">Forgot your password?</h3>
        <form id="changepass-form">
            <div class="mt-4">
                <div>
                    <label class="block" for="new password">New Password<label>
                            <input type="text" name="newpass" placeholder="Email" maxlength="30"
                                class="border-gray-300 w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600">
                </div>
                <div class="mt-4">
                    <label class="block">Confirm Password<label>
                            <input type="password" name="conpass" autocomplete="off" maxlength="30" placeholder="Password"
                                class="border-gray-300 w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600">
                </div>
                <div class="flex items-baseline justify-between">
                    <a href="#" id="forgot" class="text-sm text-blue-600 hover:underline"></a>
                    <button type="submit" class="px-6 py-2 mt-4 text-white bg-blue-600 rounded-lg hover:bg-blue-900">Login</button>
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
                success: function (data) {
                    alert(data);
                }
            });
        });
    });
</script>