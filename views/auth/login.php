<div id="login-div" class="flex items-center justify-center min-h-screen">
    <div class="px-8 py-6 mt-4 text-left bg-gray-100 shadow-md rounded" style="background-image: url('public/storage/eximage/bg3.png'); background-size: 35px 35px;">
        <h3 class="text-2xl font-extrabold text-center text-transparent bg-clip-text bg-gradient-to-r from-red-400 to-gray-900">HotPlate</h3>
        <form id="login-form">
            <!-- Alert -->
            <div id="auth-alert" class="hidden flex p-3 mb-4 mt-2 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50" role="alert">
                <svg aria-hidden="true" class="flex-shrink-0 inline w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                </svg>
                <span class="sr-only">Info</span>
                <div id="alert-msg">
                    <!-- ALert Goes here -->
                </div> 
            </div>
            <div class="mt-4">
                <div>
                    <label class="block text-gray-700" for="email">Username<label>
                    <input type="text" name="email" maxlength="40" placeholder="Enter username" class="border-gray-300 w-full px-4 py-2 mt-2 border rounded focus:outline-none focus:ring-1 focus:ring-blue-600 text-gray-900" required>
                </div>
                <div class="mt-4">
                    <label class="block text-gray-700">Password<label>
                    <input type="password" name="password" maxlength="30" autocomplete="off" placeholder="********" class="border-gray-300 w-full px-4 py-2 mt-2 border rounded focus:outline-none focus:ring-1 focus:ring-blue-600 text-gray-900" required>
                </div>
                <div class="flex items-baseline justify-between mt-2">
                    <a href="#" id="forgot" class="text-sm text-blue-600 hover:underline">Forgot your password?</a>
                    <button type="submit" class="px-6 py-2 mt-4 font-medium rounded border rounded-md border-gray-500 hover:border-gray-50 rounded-md mt-2 bg-gradient-to-r from-red-500 to-gray-700 text-white hover:text-red-200">Login</button>
                </div>
            </div>
        </form>
    </div>
</div>

<?php require('views/auth/forgot.php') ?>

<script>
    $(document).ready(function() {
        $('#login-form').submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: 'index.php?s=login',
                type: 'POST',
                data: new FormData(this),
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function(data) {
                    if (data.status == 'success') {
                        location.reload();
                    } else if (data.status == 'error') {
                        $('#auth-alert').removeClass('hidden');
                        $('#alert-msg').html(data.msg);
                    }
                }
            });
        });

        $('#forgot').click(function() {
            $('#forgot-div').removeClass('hidden');
            $('#login-div').addClass('hidden');
        });

        $('.login').click(function() {
            $('#forgot-div').addClass('hidden');
            $('#login-div').removeClass('hidden');
        });
    });
</script>