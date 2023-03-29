<div id="forgot-div" class="hidden flex items-center justify-center min-h-screen">
    <div class="px-8 py-6 mt-4 text-left bg-white shadow-lg rounded-md" style="background-image: url('public/storage/eximage/bg3.png');
            background-size: 50px 50px;">
        <h3 class="text-2xl font-extrabold text-center text-transparent bg-clip-text bg-gradient-to-r from-red-400 to-gray-900">Forgot Your Password?</h3>
        <p class="mb-4 text-sm text-gray-700 text-center">
            We get it, stuff happens. Just enter your email address <br> below and we'll send you a
            link to reset your password!
        </p>
        <form id="forgot-form">
            <!-- Alert -->
            <div id="forgot-alert" class="hidden flex p-3 mb-4 mt-2 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50" role="alert">
                <svg aria-hidden="true" class="flex-shrink-0 inline w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                </svg>
                <span class="sr-only">Info</span>
                <div id="forgot-msg">
                </div>
            </div>
            <div id="forgot-success" class="hidden flex p-4 mb-4 text-sm text-green-800 border border-green-300 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 dark:border-green-800" role="alert">
                <svg aria-hidden="true" class="flex-shrink-0 inline w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                </svg>
                <span class="sr-only">Info</span>
                <div id="forgot-success-msg">
                </div>
            </div>
            <div class="mt-4">
                <div>
                    <label class="block text-gray-700" for="email">Email<label>
                            <input type="text" name="email" id="email"  placeholder="hotplate@gmail.com" maxlength="50" class="border-gray-300 w-full px-4 py-2 mt-2 border rounded focus:outline-none focus:ring-1 focus:ring-blue-600 text-gray-900">
                </div>
                <div class="flex items-baseline justify-between">
                    <a href="#" id="login" class="text-sm text-blue-600 hover:underline">I remember my account!</a>
                    <button type="submit" class="px-6 py-2 mt-4 bg-gradient-to-r from-red-500 to-gray-700 text-white hover:text-red-200 rounded font-medium">Send</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#forgot-form').submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: 'index.php?s=pass_req',
                type: 'POST',
                data: new FormData(this),
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function(data) {
                    if (data.status == 'success') {
                        $('#forgot-alert').addClass('hidden');
                        $('#forgot-success').removeClass('hidden');
                        $('#forgot-success-msg').html(data.msg);
                        $('#email').val('');
                    } else if (data.status == 'error') {
                        $('#forgot-success').addClass('hidden');
                        $('#forgot-alert').removeClass('hidden');
                        $('#forgot-msg').html(data.msg);
                    }
                }
            });
        });
    });
</script>