<div id="defaultModal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
    <div class="relative p-4 w-full max-w-2xl h-full md:h-auto" >
        <!-- Modal content -->
        <div class="relative p-4 bg-white rounded-lg shadow sm:p-5">
            <!-- Modal header -->
            <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 text-dark">
                    Add Account
                </h3>
                <button id="exit-modal" type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="defaultModal">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <form id="add-user" action="#">
                <div class="grid gap-4 mb-4 sm:grid-cols-2">
                    <div>
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 text-dark">Name</label>
                        <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 bg-gray-100 dark:border-gray-600 dark:placeholder-gray-400 text-dark dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="User Example">
                    </div>
                    <div>
                        <label for="Username" class="block mb-2 text-sm font-medium text-gray-900 text-dark">Username</label>
                        <input type="text" name="username" id="username" class="myInput bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 bg-gray-100 dark:border-gray-600 dark:placeholder-gray-400 text-dark dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="HotPlate">
                    </div>
                    <div>
                        <label for="Email" class="block mb-2 text-sm font-medium text-gray-900 text-dark">Email</label>
                        <input type="text" name="email" id="email" class="myInput bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 bg-gray-100 dark:border-gray-600 dark:placeholder-gray-400 text-dark dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="hotplate@gmail.com">
                    </div>
                    <div>
                        <label for="Role" class="block mb-2 text-sm font-medium text-gray-900 text-dark">Role</label>
                        <select name="role" id="role" class="myInput bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 bg-gray-100 dark:border-gray-600 dark:placeholder-gray-400 text-dark dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="50 kg">
                            <option value="Cashier">Cashier</option>
                            <option value="Chef">Chef</option>
                            <option value="Admin">Admin</option>
                        </select>
                    </div>
                    <div>
                        <label for="Password" class="block mb-2 text-sm font-medium text-gray-900 text-dark">Password</label>
                        <input type="password" name="password" id="password" class="myInput bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 bg-gray-100 dark:border-gray-600 dark:placeholder-gray-400 text-dark dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="********">
                    </div>
                </div>
                <div class="flex">
                    <button type="submit" class="ml-auto px-4 py-2 inline-flex border rounded-md border-gray-500 bg-gradient-to-r from-red-500 to-gray-700 text-white hover:text-red-200 rounded-md shadow-md hover:border-gray-50">
                        Add
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#add-user').submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: 'index.php?s=add_user',
                method: 'POST',
                data: $(this).serialize(),
                dataType: 'json',
                success: function(data) {
                    if (data.status == 'success') {
                        swal("Success!", data.msg, data.status).then(function() {
                            window.location.reload();
                        });
                    } else {
                        swal("Error!", data.msg);
                    }
                }
            });
        });
    });
</script>