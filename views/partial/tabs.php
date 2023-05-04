<div class="border-b border-gray-300 shadow bg-gray-50" style="background-image: url('public/storage/eximage/bg3.png'); background-size: 20px 20px;">
    <ul class="overflow-x-auto w-screen flex -mb-px text-sm font-medium text-center text-gray-700">
        <li class="mr-2">
            <a href="?p" class="<?= urlIs('p') ? 'font-bold text-transparent bg-clip-text bg-gradient-to-r from-red-500 to-gray-900 hover:text-red-800' : ' hover:text-gray-300 hover:border-gray-300' ?> inline-flex p-4 border-b-2 border-transparent rounded-t-lg" aria-current="page">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="<?= urlIs('p') ? 'text-rose-600' : 'text-gray-500' ?> w-5 h-5 mr-2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 7.5l-2.25-1.313M21 7.5v2.25m0-2.25l-2.25 1.313M3 7.5l2.25-1.313M3 7.5l2.25 1.313M3 7.5v2.25m9 3l2.25-1.313M12 12.75l-2.25-1.313M12 12.75V15m0 6.75l2.25-1.313M12 21.75V19.5m0 2.25l-2.25-1.313m0-16.875L12 2.25l2.25 1.313M21 14.25v2.25l-2.25 1.313m-13.5 0L3 16.5v-2.25" />
                </svg>
                Dashboard
            </a>
        </li>

        <li class="mr-2">
            <a href="?p=menu" class="<?= urlIs('p=menu') ? 'font-bold text-transparent bg-clip-text bg-gradient-to-r from-red-500 to-gray-900 hover:text-red-800' : ' hover:text-gray-300 hover:border-gray-300 group' ?> inline-flex p-4 border-b-2 border-transparent rounded-t-lg" aria-current="page">
                <svg aria-hidden="true" class="<?= urlIs('p=menu') ? 'text-rose-600' : 'text-gray-500' ?> w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                </svg>Menu
            </a>
        </li>
        <li class="mr-2">
            <a href="?p=receipts" class="<?= urlIs('p=receipts') ? 'font-bold text-transparent bg-clip-text bg-gradient-to-r from-red-500 to-gray-900 hover:text-red-800' : ' hover:text-gray-300 hover:border-gray-300 group' ?> inline-flex p-4 border-b-2 border-transparent rounded-t-lg">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="<?= urlIs('p=receipts') ? 'text-rose-600' : 'text-gray-500' ?> w-5 h-5 mr-2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 14.25l6-6m4.5-3.493V21.75l-3.75-1.5-3.75 1.5-3.75-1.5-3.75 1.5V4.757c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0111.186 0c1.1.128 1.907 1.077 1.907 2.185zM9.75 9h.008v.008H9.75V9zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm4.125 4.5h.008v.008h-.008V13.5zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                </svg>
                Receipts
            </a>
        </li>
        <li class="mr-2">
            <a href="?p=order" class="<?= urlIs('p=order') ? 'font-bold text-transparent bg-clip-text bg-gradient-to-r from-red-500 to-gray-900 hover:text-red-800' : ' hover:text-gray-300 hover:border-gray-300 group' ?> inline-flex p-4 border-b-2 border-transparent rounded-t-lg relative indicator">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="<?= urlIs('p=order') ? 'text-rose-600' : 'text-gray-500' ?> w-5 h-5 mr-2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M11.35 3.836c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m8.9-4.414c.376.023.75.05 1.124.08 1.131.094 1.976 1.057 1.976 2.192V16.5A2.25 2.25 0 0118 18.75h-2.25m-7.5-10.5H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V18.75m-7.5-10.5h6.375c.621 0 1.125.504 1.125 1.125v9.375m-8.25-3l1.5 1.5 3-3.75" />
                </svg>
                Kitchen
                <div class="ml-2 inline-flex -mb-2 items-center justify-center w-6 h-6 text-xs font-bold text-white bg-red-500 border-2 border-white rounded-full count hidden"></div>
            </a>
        </li>
        <li class="mr-2">
            <a href="?p=history" class="<?= urlIs('p=history') ? 'font-bold text-transparent bg-clip-text bg-gradient-to-r from-red-500 to-gray-900 hover:text-red-800' : ' hover:text-gray-300 hover:border-gray-300 group' ?> inline-flex p-4 border-b-2 border-transparent rounded-t-lg relative">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="<?= urlIs('p=history') ? 'text-rose-600' : 'text-gray-500' ?> w-5 h-5 mr-2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25zM6.75 12h.008v.008H6.75V12zm0 3h.008v.008H6.75V15zm0 3h.008v.008H6.75V18z" />
                </svg>
                History
            </a>
        </li>
        <li class="mr-2">
            <a href="?p=product" class="<?= urlIs('p=product') || urlIs('p=meals') || urlIs('p=drinks') ? 'font-bold text-transparent bg-clip-text bg-gradient-to-r from-red-500 to-gray-900 hover:text-red-800' : ' hover:text-gray-300 hover:border-gray-300 group' ?> inline-flex p-4 border-b-2 border-transparent rounded-t-lg">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="<?= urlIs('p=product') || urlIs('p=meals') || urlIs('p=drinks') ? 'text-rose-600' : 'text-gray-500' ?> w-5 h-5 mr-2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.098 19.902a3.75 3.75 0 005.304 0l6.401-6.402M6.75 21A3.75 3.75 0 013 17.25V4.125C3 3.504 3.504 3 4.125 3h5.25c.621 0 1.125.504 1.125 1.125v4.072M6.75 21a3.75 3.75 0 003.75-3.75V8.197M6.75 21h13.125c.621 0 1.125-.504 1.125-1.125v-5.25c0-.621-.504-1.125-1.125-1.125h-4.072M10.5 8.197l2.88-2.88c.438-.439 1.15-.439 1.59 0l3.712 3.713c.44.44.44 1.152 0 1.59l-2.879 2.88M6.75 17.25h.008v.008H6.75v-.008z" />
                </svg>
                Product
            </a>
        </li>
        <li class="mr-2">
            <a href="?p=inventory" class="<?= urlIs('p=inventory') ? 'font-bold text-transparent bg-clip-text bg-gradient-to-r from-red-500 to-gray-900 hover:text-red-800' : ' hover:text-gray-300 hover:border-gray-300 group' ?> inline-flex p-4 border-b-2 border-transparent rounded-t-lg line-through decoration-2 decoration-double decoration-red-500">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="<?= urlIs('p=inventory') ? 'text-rose-600' : 'text-gray-500' ?> w-5 h-5 mr-2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 00-3.213-9.193 2.056 2.056 0 00-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 00-10.026 0 1.106 1.106 0 00-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12" />
                </svg>
                Inventory
            </a>
        </li>
        <li class="mr-2">
            <a href="?p=docs" class="<?= urlIs('p=docs') ? 'font-bold text-transparent bg-clip-text bg-gradient-to-r from-red-500 to-gray-900 hover:text-red-800' : ' hover:text-gray-300 hover:border-gray-300 group' ?> inline-flex p-4 border-b-2 border-transparent rounded-t-lg">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="<?= urlIs('p=docs') ? 'text-rose-600' : 'text-gray-500' ?> w-5 h-5 mr-2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9 5.25h.008v.008H12v-.008z" />
                </svg>
                Docs
            </a>
        </li>
        <li class="ml-auto mr-14">
            <a id="dropdownRightEndButton" data-dropdown-toggle="dropdownRightEnd" href="#" class="mt-4 inline-flex">
                <p class="mr-2 mt-1 capitalize text-transparent bg-clip-text bg-gradient-to-r from-rose-700 to-gray-900 hover:text-rose-500">
                    <?php
                    $name = Auth::user($_COOKIE['log_id']);
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
            swal({
                title: "Are you sure?",
                text: "Once logged out, you will not be able to access this page!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: 'index.php?s=logout',
                        success: function(data) {
                            location.reload(true);
                        }
                    })
                }
            });
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