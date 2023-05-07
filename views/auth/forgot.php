<div id="forgot-div" class="hidden flex items-center justify-center min-h-screen">
    <div class="px-8 py-6 mt-4 text-left bg-gray-100 shadow-md rounded-md" style="background-image: url('public/storage/eximage/bg3.png'); background-size: 35px 35px;">
        <h3 class="text-2xl font-extrabold text-center text-transparent bg-clip-text bg-gradient-to-r from-red-400 to-gray-900">Forgot Your Password?</h3>
        <p class="mb-2 mt-2 text-sm text-gray-700 text-center">
            We get it, stuff happens. Just enter your email address <br> below and and Answer Security Question to Reset Password.
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
            <div id="forgot-success" class="hidden flex p-4 mb-4 text-sm text-green-800 border border-green-300 rounded-lg bg-green-50" role="alert">
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
                            <input type="text" name="email" id="email" placeholder="Enter email" maxlength="50" class="border-gray-300 w-full px-4 py-2 mt-1 border rounded focus:outline-none focus:ring-1 focus:ring-blue-600 text-gray-900" required>
                </div>
                <div id="sendbtn" class="flex items-baseline justify-between mt-2">
                    <a href="#" class="login text-sm text-blue-600 hover:underline">I remember my account!</a>
                    <button type="submit" id="send" class="px-6 py-2 mt-4 font-medium rounded border rounded-md border-gray-500 hover:border-gray-50 rounded-md mt-2 bg-gradient-to-r from-red-500 to-gray-700 text-white hover:text-red-200">Submit</button>
                    <div role="status" id="loading" class="hidden">
                        <svg aria-hidden="true" class="inline w-8 h-8 mr-2 text-gray-200 animate-spin dark:text-gray-600 fill-red-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor" />
                            <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill" />
                        </svg>
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
            </div>
        </form>
        <form id="question-form" class="hidden">
            <div class="mt-2">
                <label class="block text-gray-700" for="Hint">Hint</label>
                <input type="text" name="hint" id="hint" class="border-gray-300 w-full px-4 py-2 mt-1 border rounded focus:outline-none focus:ring-1 focus:ring-blue-600 text-gray-900">
            </div>
            <div>
                <label class="block text-gray-700" for="Answer">Answer</label>
                <input type="text" name="answer" id="answer" placeholder="Enter Answer" class="border-gray-300 w-full px-4 py-2 mt-1 border rounded focus:outline-none focus:ring-1 focus:ring-blue-600 text-gray-900" required>
            </div>
            <div>
                <label class="block text-gray-700" for="newpassword">New Password</label>
                <input type="text" name="newpassword" id="newpassword" placeholder="Enter new password" class="border-gray-300 w-full px-4 py-2 mt-1 border rounded focus:outline-none focus:ring-1 focus:ring-blue-600 text-gray-900" required>
            </div>
            <div>
                <label class="block text-gray-700" for="retypepassword">Retype Password</label>
                <input type="text" name="retypepassword" id="retypepassword" placeholder="Retype new password" class="border-gray-300 w-full px-4 py-2 mt-1 border rounded focus:outline-none focus:ring-1 focus:ring-blue-600 text-gray-900" required>
            </div>
            <div class="flex items-baseline justify-between mt-2">
                <a href="#" class="login text-sm text-blue-600 hover:underline">I remember my account!</a>
                <button type="submit" class="px-6 py-2 mt-4 font-medium rounded border rounded-md border-gray-500 hover:border-gray-50 rounded-md mt-2 bg-gradient-to-r from-red-500 to-gray-700 text-white hover:text-red-200">Submit</button>
            </div>
        </form>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#forgot-form').submit(function(e) {
            e.preventDefault();
            $('#send').addClass('hidden');
            $('#loading').removeClass('hidden');
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
                        $('#note').addClass('hidden');
                        $('#sendbtn').addClass('hidden');
                        $('#question-form').removeClass('hidden');
                        $('#email').prop('disabled', true)
                        $('#hint').val(data.hint);
                        setTimeout(function() {
                            $('#forgot-success').slideUp('hidden');
                        }, 4000);
                    } else if (data.status == 'error') {
                        $('#forgot-success').addClass('hidden');
                        $('#forgot-alert').removeClass('hidden');
                        $('#forgot-msg').html(data.msg);
                        $('#send').removeClass('hidden');
                        $('#loading').addClass('hidden');
                    }
                }
            });
        });

        $('#question-form').submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: 'index.php?s=confirm_answer',
                type: 'POST',
                data: {
                    'email': $('#email').val(),
                    'answer': $('#answer').val(),
                    'newpassword': $('#newpassword').val(),
                    'retypepassword': $('#retypepassword').val()
                },
                dataType: 'json',
                success: function(resp) {
                    if (resp.status == 'success') {
                        swal({
                            title: "Success",
                            text: resp.msg,
                            icon: resp.status,
                            button: "Ok",
                        }).then(function() {
                            window.location = "./";
                        });
                    } else {
                        swal({
                            title: resp.msg,
                            icon: resp.status,
                            button: "Ok",
                        });
                    }
                }
            });
        })
    });
</script>