<section class="p-6 text-gray-50 container flex flex-col mx-auto space-y-12 ng-untouched ng-pristine ng-valid">
    <form id="profile" class="bg-gray-100 rounded-md shadow-sm">
        <fieldset class="grid grid-cols-4 gap-6 p-6 rounded-md bg-gray-100" style="background-image: url('public/storage/eximage/bg3.png'); background-size: 20px 20px;">
            <div class="space-y-2 col-span-full lg:col-span-1">
                <p class="font-medium text-gray-900">Profile Settings</p>
                <!-- <p class="text-xs"></p> -->
            </div>
            <?php foreach (Auth::user($_SESSION['log_id']) as $user) { ?>
                <div class="grid grid-cols-6 gap-4 col-span-full lg:col-span-3">
                    <div class="col-span-full sm:col-span-3">
                        <label for="name" class="text-sm text-gray-700">Name</label>
                        <input id="name" type="text" name="name" placeholder="John Doe" value="<?= $user['name'] ?>" class="bg-gray-50 border text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" required>
                    </div>
                    <div class="col-span-full sm:col-span-3">
                        <label for="username" class="text-sm text-gray-700">Username</label>
                        <input id="username" type="text" name="username" placeholder="Username" value="<?= $user['username'] ?>" class="bg-gray-50 border text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" required>
                    </div>
                    <div class="col-span-full sm:col-span-3">
                        <label for="email" class="text-sm text-gray-700">Email</label>
                        <input id="email" type="email" name="email" placeholder="example300@gmail.com" value="<?= $user['email'] ?>" class="bg-gray-50 border text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" required>
                    </div>
                    <div class="col-span-full sm:col-span-3">
                        <label for="role" class="text-sm text-gray-700">Position <span class="text-red-500">This field can't be change.</span></label>
                        <input id="role" type="text" disabled placeholder="Cashier" value="<?= ucfirst($user['role']) ?>" class="bg-gray-50 border text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" required>
                    </div>
                </div>
            <?php } ?>
        </fieldset>
        <div class="flex" style="background-image: url('public/storage/eximage/bg3.png'); background-size: 20px 20px;">
            <button type="submit" class="ml-auto mb-5 mr-6 px-4 py-2 border rounded-md border-gray-500 bg-gradient-to-r from-red-500 to-gray-700 text-white hover:text-red-200 rounded-md shadow-md hover:border-gray-50">Save</button>
        </div>
    </form>

    <form id="recovery" class="bg-gray-100 rounded-md shadow-sm">
        <fieldset class="grid grid-cols-4 gap-6 p-6 rounded-md bg-gray-100" style="background-image: url('public/storage/eximage/bg3.png'); background-size: 20px 20px;">
            <div class="space-y-2 col-span-full lg:col-span-1">
                <p class="font-medium text-gray-900">Recovery Account</p>
            </div>
            <div class="grid grid-cols-6 gap-4 col-span-full lg:col-span-3">
                <div class="col-span-full sm:col-span-3">
                    <label for="Hint" class="text-sm text-gray-700">Hint</label>
                    <input id="hint" type="text" name="hint" placeholder="Enter hint" value="<?= mysqli_fetch_array(Auth::user($_SESSION['log_id']))['hint'] ?>" class="bg-gray-50 border text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" required>
                </div>
                <div class="col-span-full sm:col-span-3">
                    <label for="answer" class="text-sm text-gray-700">Answer</label>
                    <input id="answer" type="password" name="answer" placeholder="Enter Answer" value="<?= mysqli_fetch_array(Auth::user($_SESSION['log_id']))['answer'] ?>" class="bg-gray-50 border text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" required>
                </div>
            </div>
        </fieldset>
        <div class="flex" style="background-image: url('public/storage/eximage/bg3.png'); background-size: 20px 20px;">
            <button type="submit" class="ml-auto mb-5 mr-6 px-4 py-2 border rounded-md border-gray-500 bg-gradient-to-r from-red-500 to-gray-700 text-white hover:text-red-200 rounded-md shadow-md hover:border-gray-50">Save</button>
        </div>
    </form>

    <form id="changePass" class="bg-gray-100 rounded-md shadow-sm">
        <fieldset class="grid grid-cols-4 gap-6 p-6 rounded-md bg-gray-100" style="background-image: url('public/storage/eximage/bg3.png'); background-size: 20px 20px;">
            <div class="space-y-2 col-span-full lg:col-span-1">
                <p class="font-medium text-gray-900">Change Password</p>
                <!-- <p class="text-xs"></p> -->
            </div>
            <div class="grid grid-cols-6 gap-4 col-span-full lg:col-span-3">
                <div class="col-span-full sm:col-span-3">
                    <label for="current password" class="text-sm text-gray-700">Current Password</label>
                    <input id="oldPassword" type="password" name="currentPassword" placeholder="**********" class="bg-gray-50 border text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" required>
                </div>
                <div class="col-span-full sm:col-span-3">
                    <label for="New password" class="text-sm text-gray-700">New Password</label>
                    <input id="newPassword" type="password" name="newPassword" placeholder="**********" class="bg-gray-50 border text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" required>
                </div>
                <div class="col-span-full sm:col-span-3">
                    <label for="retype password" class="text-sm text-gray-700">Retype Password</label>
                    <input id="RetypePassword" type="password" name="retypePassword" placeholder="**********" class="bg-gray-50 border text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" required>
                </div>
            </div>
        </fieldset>
        <div class="flex" style="background-image: url('public/storage/eximage/bg3.png'); background-size: 20px 20px;">
            <button type="submit" class="ml-auto mb-5 mr-6 px-4 py-2 border rounded-md border-gray-500 bg-gradient-to-r from-red-500 to-gray-700 text-white hover:text-red-200 rounded-md shadow-md hover:border-gray-50">Save</button>
        </div>
    </form>
</section>

<script>
    $(document).ready(function() {
        $('#profile').submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: 'index.php?s=update_profile',
                method: 'POST',
                data: $(this).serialize(),
                dataType: 'json',
                success: function(data) {
                    if (data.status == 'success') {
                        swal({
                            title: "Success!",
                            text: data.msg,
                            icon: "success",
                            button: "OK",
                        });
                    } else {
                        swal({
                            title: "Error!",
                            text: data.msg,
                            icon: "error",
                            button: "OK",
                        });
                    }
                }
            });
        });

        $('#changePass').submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: 'index.php?s=change_user_password',
                method: 'POST',
                data: $(this).serialize(),
                dataType: 'json',
                success: function(data) {
                    if (data.status == 'success') {
                        swal({
                            title: "Success!",
                            text: data.msg,
                            icon: "success",
                            button: "OK",
                        });
                    } else {
                        swal({
                            title: "Error!",
                            text: data.msg,
                            icon: "error",
                            button: "OK",
                        });
                    }
                }
            });
        });

        $('#recovery').submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: 'index.php?s=recovery_account',
                method: 'POST',
                data: $(this).serialize(),
                dataType: 'json',
                success: function(data) {
                    if (data.status == 'success') {
                        swal({
                            title: "Success!",
                            text: data.msg,
                            icon: "success",
                            button: "OK",
                        });
                    } else {
                        swal({
                            title: "Error!",
                            text: data.msg,
                            icon: "error",
                            button: "OK",
                        });
                    }
                }
            });
        });
    });
</script>