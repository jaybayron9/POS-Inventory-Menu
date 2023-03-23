<div class="border-b border-gray-200 dark:border-gray-300 shadow bg-gray-50">
    <ul class="overflow-x-auto w-screen flex -mb-px text-sm font-medium text-center text-gray-500 dark:text-gray-400">
        <li class="mr-2">
            <a href="?p" class="<?= urlIs('p') ? 'font-bold text-transparent bg-clip-text bg-gradient-to-r from-red-500 to-gray-900 hover:text-red-800' : ' hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300 group' ?> inline-flex p-4 border-b-2 border-transparent rounded-t-lg" aria-current="page">
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="<?= urlIs('p') ? 'text-rose-600' : 'text-gray-500' ?> w-5 h-5 mr-2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 3v11.25A2.25 2.25 0 006 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0118 16.5h-2.25m-7.5 0h7.5m-7.5 0l-1 3m8.5-3l1 3m0 0l.5 1.5m-.5-1.5h-9.5m0 0l-.5 1.5M9 11.25v1.5M12 9v3.75m3-6v6" />
                </svg>
                Dashboard
            </a>
        </li>
        <li class="mr-2">
            <a href="?p=menu" class="<?= urlIs('p=menu') ? 'font-bold text-transparent bg-clip-text bg-gradient-to-r from-red-500 to-gray-900 hover:text-red-800' : ' hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300 group' ?> inline-flex p-4 border-b-2 border-transparent rounded-t-lg" aria-current="page">
                <svg aria-hidden="true" class="<?= urlIs('p=menu') ? 'text-rose-600' : 'text-gray-500' ?> w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                </svg>Menu
            </a>
        </li>
        <li class="mr-2">
            <a href="?p=order" class="<?= urlIs('p=order') ? 'font-bold text-transparent bg-clip-text bg-gradient-to-r from-red-500 to-gray-900 hover:text-red-800' : ' hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300 group' ?> inline-flex p-4 border-b-2 border-transparent rounded-t-lg relative indicator">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="<?= urlIs('p=order') ? 'text-rose-600' : 'text-gray-500' ?> w-5 h-5 mr-2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 12h16.5m-16.5 3.75h16.5M3.75 19.5h16.5M5.625 4.5h12.75a1.875 1.875 0 010 3.75H5.625a1.875 1.875 0 010-3.75z" />
                </svg>
                Kitchen
                <div class="ml-2 inline-flex -mb-2 items-center justify-center w-6 h-6 text-xs font-bold text-white bg-red-500 border-2 border-white rounded-full count hidden"></div>
            </a>
        </li>
        <li class="mr-2">
            <a href="?p=history" class="<?= urlIs('p=history') ? 'font-bold text-transparent bg-clip-text bg-gradient-to-r from-red-500 to-gray-900 hover:text-red-800' : ' hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300 group' ?> inline-flex p-4 border-b-2 border-transparent rounded-t-lg relative">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="<?= urlIs('p=history') ? 'text-rose-600' : 'text-gray-500' ?> w-5 h-5 mr-2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M11.35 3.836c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m8.9-4.414c.376.023.75.05 1.124.08 1.131.094 1.976 1.057 1.976 2.192V16.5A2.25 2.25 0 0118 18.75h-2.25m-7.5-10.5H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V18.75m-7.5-10.5h6.375c.621 0 1.125.504 1.125 1.125v9.375m-8.25-3l1.5 1.5 3-3.75" />
                </svg>
                History
            </a>
        </li>
        <li class="mr-2">
            <a href="?p=product" class="<?= urlIs('p=product') || urlIs('p=meals') || urlIs('p=drinks') ? 'font-bold text-transparent bg-clip-text bg-gradient-to-r from-red-500 to-gray-900 hover:text-red-800' : ' hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300 group' ?> inline-flex p-4 border-b-2 border-transparent rounded-t-lg">
                <svg aria-hidden="true" class="<?= urlIs('p=product') || urlIs('p=meals') || urlIs('p=drinks') ? 'text-rose-600' : 'text-gray-500' ?> w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"></path>
                    <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"></path>
                </svg>
                Product
            </a>
        </li>
        <li class="mr-2">
            <a href="?p=inventory" class="<?= urlIs('p=inventory') ? 'font-bold text-transparent bg-clip-text bg-gradient-to-r from-red-500 to-gray-900 hover:text-red-800' : ' hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300 group' ?> inline-flex p-4 border-b-2 border-transparent rounded-t-lg">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="<?= urlIs('p=inventory') ? 'text-rose-600' : 'text-gray-500' ?> w-5 h-5 mr-2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25zM6.75 12h.008v.008H6.75V12zm0 3h.008v.008H6.75V15zm0 3h.008v.008H6.75V18z" />
                </svg>
                Inventory
            </a>
        </li>
        <li class="ml-auto mr-14"> 
            <a id="dropdownRightEndButton" data-dropdown-toggle="dropdownRightEnd" href="#" class="mt-4 inline-flex">
                <p class="mr-2 mt-1 capitalize text-transparent bg-clip-text bg-gradient-to-r from-rose-700 to-gray-900 hover:text-rose-500">
                    <?php 
                        $name = Auth::user($_SESSION['log_id']);
                        echo mysqli_fetch_array($name)['name'];
                    ?>
                </p>
                <img src="public/storage/uploads/user.png" alt="" class="w-7 h-7 rounded-full bg-gray-200 p-1">
            </a>
            <!-- Dropdown menu -->
            <div id="dropdownRightEnd" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-32 bg-gray-100">
                <ul class="py-2 text-sm text-gray-200" aria-labelledby="dropdownRightEndButton">
                    <li>
                        <a href="?p=users" class="block px-4 py-2 text-gray-700 bg-gray-100 hover:bg-gray-600 hover:text-white">Users</a>
                    </li>
                    <li>
                        <a href="?p=profile" class="block px-4 py-2 text-gray-700 bg-gray-100 hover:bg-gray-600 hover:text-white">Profile</a>
                    </li>
                    <li>
                        <a href="?p=settings" class="block px-4 py-2 text-gray-700 bg-gray-100 hover:bg-gray-600 hover:text-white">Settings</a>
                    </li>
                    <li>
                        <a href="#" id="logout" class="block px-4 py-2 text-gray-700 bg-gray-100 hover:bg-gray-600 hover:text-white">Log out</a>
                    </li>
                </ul>
            </div>
        </li>
    </ul>
</div>

<script>
    $(document).ready(function() {
        $('#logout').click(function() {
            if (confirm('Are you sure you want to logout?')) {
                $.ajax({
                    url: 'index.php?s=logout',
                    success: function(data) {
                        location.reload(true);
                    }
                })
            }
        });

        function load_unseen_notification(view = '') {
            $.ajax({
                url: "index.php?a=notif_orders",
                method: "POST",
                data: {
                    view: view
                },
                dataType: "json",
                success: function(data) {
                    if (data.unseen_notification !== 0) {
                        $('.count').removeClass('hidden');
                        $('.indicator').html(data.notification);

                        if (data.unseen_notification > 0) {
                            $('.count').html(data.unseen_notification);
                        }
                    }
                }
            });
        }
        load_unseen_notification();

        $(document).on('click', '.indicator', function() {
            $('.count').html('');
            load_unseen_notification('yes');
        });

        setInterval(function() {
            load_unseen_notification();
        }, 5000);
    });
</script>