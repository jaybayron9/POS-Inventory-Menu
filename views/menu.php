<section class="pt-8 pb-8">
    <div class="mx-auto">
        <div class="grid md:grid-cols-3">
            <div class="col-span-2 ml-4 mb-2 rounded-lg shadow-lg bg-gray-50" data-drawer-hide="drawer-backdrop" aria-controls="drawer-backdrop" style="background-image: url('public/storage/eximage/bg3.png'); background-repeat: repeat; background-size: 25px 25px;">
                <div class="flex py-4">
                    <ol class="inline-flex items-center mx-auto">
                        <li class="inline-flex items-center mr-2">
                            🥘
                            <a id="nav-meals" href="#" class="inline-flex font-bold text-xl	 items-center text-sm font-medium text-transparent bg-clip-text bg-gradient-to-r from-red-700 to-gray-900 hover:text-red-700">
                                Meals
                            </a>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <!-- <span class="font-extrabold mr-2 font-bold text-2xl py-3"></span> -->
                                🍹
                                <a id="nav-drinks" href="#" class="inline-flex font-bold text-xl items-center text-sm font-medium text-transparent bg-clip-text bg-gradient-to-r from-blue-700 to-gray-900 hover:text-blue-700">
                                    Drinks
                                </a>
                            </div>
                        </li>
                    </ol>
                    <input type="search" name="" placeholder="Search" class="search mx-auto text-center ml-auto h-8 rounded-md shadow bg-gray-50 w-2/4 font-medium border-gray-400">
                </div>
                <ul id="meals-menu" class="meal-list pr-3">
                    <div class="grid xl:grid-cols-6 md:grid-cols-4 sm:grid-cols-4 grid-cols-4 gap-3 ml-3 mb-4">
                        <?php
                        foreach ($menu->products_menu('meals') as $product) {
                        ?>
                            <li class="meal">
                                <div class="bg-cover bg-center bg-no-repeat rounded-md shadow-xl" style="background-image: url('public/storage/uploads/<?= $product['picture'] !== Null ? $product['picture'] : 'default.jpg' ?>'); height: 130px; width: 130px;">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="absolute w-10 h-9 text-red-500">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.362 5.214A8.252 8.252 0 0112 21 8.25 8.25 0 016.038 7.048 8.287 8.287 0 009 9.6a8.983 8.983 0 013.361-6.867 8.21 8.21 0 003 2.48z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 18a3.75 3.75 0 00.495-7.467 5.99 5.99 0 00-1.925 3.546 5.974 5.974 0 01-2.133-1A3.75 3.75 0 0012 18z" />
                                    </svg>
                                    <div class="absolute font-medium ml-2 mt-2 z-50 text-white">
                                        <a data-row-data="<?= $product['product_id'] . ',' . $product['name'] . ',' . $product['price'] ?>" class="sub-button hover:cursor-pointer">
                                            <?= $product['price'] ?>
                                        </a>
                                    </div>
                                    <div class="<?= $product['status'] == 'Available' ? 'hidden' : '' ?> absolute ml-8 font-bold" style="font-size:18px">
                                        <p class="text-rose-500 bg-gray-200 rotate-45 mt-7 px-1"><?= $product['status'] ?></p>
                                    </div>
                                    <div class="flex">
                                        <span class="inline-flex justify-center items-center font-bold text-red-500"></span>
                                        <a data-row-data="<?= $product['product_id'] . ',' . $product['name'] . ',' . $product['price'] ?>" style="height: 130px; width: 130px;" class="<?= $product['status'] !== 'Out of Stock' ? 'add-button' : '' ?> hover:cursor-pointer rounded-lg ml-auto inline-flex justify-center items-center p-1 text-sm font-medium bg-transparent border hover:bg-gray-100 hover:opacity-50 dark:text-gray-800 dark:focus:ring-gray-700 z-100 pb-6" type="button">
                                        </a>
                                    </div>
                                </div>
                                <div class="text-center -mt-20 mb-3" style="font-size: 23px;">
                                    <p data-row-data="<?= $product['product_id'] . ',' . $product['name'] . ',' . $product['price'] ?>" class="<?= $product['status'] !== 'Out of Stock' ? 'add-button' : '' ?> font-bold text-white"><?= $product['name'] ?></p>
                                </div>
                            </li>
                        <?php } ?>
                    </div>
                </ul>
                <ul id="drinks-menu" class="meal-list hidden pr-3">
                    <div class="grid xl:grid-cols-6 md:grid-cols-4 sm:grid-cols-4 grid-cols-4 gap-3 ml-3 mb-4">
                        <?php
                        foreach ($menu->products_menu('drinks') as $product) {
                        ?>
                            <li class="meal">
                                <div class="bg-cover bg-center bg-no-repeat rounded-md shadow-xl" style="background-image: url('public/storage/uploads/<?= $product['picture'] !== Null ? $product['picture'] : 'default.jpg' ?>'); height: 130px; width: 130px;">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="absolute w-10 h-9 text-red-500">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.362 5.214A8.252 8.252 0 0112 21 8.25 8.25 0 016.038 7.048 8.287 8.287 0 009 9.6a8.983 8.983 0 013.361-6.867 8.21 8.21 0 003 2.48z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 18a3.75 3.75 0 00.495-7.467 5.99 5.99 0 00-1.925 3.546 5.974 5.974 0 01-2.133-1A3.75 3.75 0 0012 18z" />
                                    </svg>
                                    <div class="absolute font-medium ml-2 mt-2 z-50 text-white">
                                        <a data-row-data="<?= $product['product_id'] . ',' . $product['name'] . ',' . $product['price'] ?>" class="sub-button hover:cursor-pointer">
                                            <?= $product['price'] ?>
                                        </a>
                                    </div>
                                    <div class="<?= $product['status'] == 'Available' ? 'hidden' : '' ?> absolute ml-8 font-bold" style="font-size:18px">
                                        <p class="text-rose-500 bg-gray-200 rotate-45 mt-7 px-1"><?= $product['status'] ?></p>
                                    </div>
                                    <div class="flex">
                                        <span class="inline-flex justify-center items-center font-bold text-red-500"></span>
                                        <a data-row-data="<?= $product['product_id'] . ',' . $product['name'] . ',' . $product['price'] ?>" style="height: 130px; width: 130px;" class="<?= $product['status'] !== 'Out of Stock' ? 'add-button' : '' ?> hover:cursor-pointer rounded-lg ml-auto inline-flex justify-center items-center p-1 text-sm font-medium bg-transparent border hover:bg-gray-100 hover:opacity-50 dark:text-gray-800 dark:focus:ring-gray-700 z-100 pb-6" type="button">
                                        </a>
                                    </div>
                                </div>
                                <div class="text-center -mt-20 mb-5" style="font-size: 23px;">
                                    <p class="<?= $product['status'] !== 'Out of Stock' ? 'add-button' : '' ?> font-bold text-white"><?= $product['name'] ?></p>
                                </div>
                            </li>
                        <?php } ?>
                    </div>
                </ul>
            </div>

            <div class="col-span-1 mx-4 mb-2 rounded-lg shadow-lg bg-gray-50 sticky top-6" style="height: fit-content; background-image: url('public/storage/eximage/bg3.png'); background-repeat: repeat; background-size: 25px 25px;">
                <div class="px-2 mb-3">
                    <div style="height: 410px" data-drawer-hide="drawer-backdrop" aria-controls="drawer-backdrop">
                        <div class="d-table overflow-x-auto" style="max-height: 400px;">
                            <table id="menu-table" class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                <thead class="text-xs text-gray-700 uppercase sticky top-0 z-50">
                                    <tr class="border-b border-gray-100 shadow">
                                        <th scope="col" class="px-4 py-3">
                                            Product
                                        </th>
                                        <th scope="col" class="px-4 py-3">
                                            Price
                                        </th>
                                        <th scope="col" class="px-4 py-3">
                                            Quantity
                                        </th>
                                        <th scope="col" class="px-4 py-3">
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody id="order-list" class="">
                                    <!-- Orders Goes Here -->
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div data-drawer-hide="drawer-backdrop" aria-controls="drawer-backdrop">
                        <div class="flex w-full border-t border-gray-200">
                            <p class="p-3 ml-3 font-semibold text-xs">SUBTOTAL</p>
                            <p class="p-3 mx-16 font-semibold text-xl text-gray-700">₱ <span id="total"></span></p>
                        </div>
                        <div class="discounttotal hidden flex w-full bg-gray-50 border-t border-gray-200">
                            <p class="p-3 ml-3 font-semibold text-xs">TOTAL DISCOUNT</p>
                            <p class="p-3 mx-6 font-semibold text-2xl text-gray-900">₱ <span id="finaltotal"></span></p>
                        </div>
                    </div>

                    <!-- Alert -->
                    <div id="success-alert" class="<?= !isset($_SESSION['success']) ? 'hidden' : '' ?> flex px-4">
                        <div class="flex px-4 py-2 mb-4 text-sm text-green-800 rounded-lg bg-green-100 text-green-700 w-full" role="alert">
                            <svg aria-hidden="true" class="flex-shrink-0 inline w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="sr-only">Info</span>
                            <div>
                                <span class="font-medium"><?= $_SESSION['success'] ?></span>
                            </div>
                        </div>
                    </div>

                    <div id="error-alert-div" class="flex hidden px-4">
                        <div class="flex px-4 py-2 w-full mb-4 text-sm text-red-800 rounded-lg bg-red-100 text-red-700" role="alert">
                            <svg aria-hidden="true" class="flex-shrink-0 inline w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="sr-only">Info</span>
                            <div>
                                <span id="error-alert-msg" class="font-medium"></span>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center justify-center gap-3 mb-1 px-2">
                        <div>
                            <label for="Payment amount" class="font-semibold text-xs">PAYMENT</label>
                            <input type="text" id="payment-amount" name="payment_amount" title="Payment amount" placeholder="0" maxlength="5" class="w-full rounded-l-md border-gray-400 shadow-md text-green-600 myInput placeholder:text-green-500" data-drawer-target="drawer-backdrop" data-drawer-show="drawer-backdrop" data-drawer-backdrop="false" aria-controls="drawer-backdrop">
                        </div>

                        <div data-drawer-hide="drawer-backdrop" aria-controls="drawer-backdrop">
                            <label for="Change" class="font-semibold text-xs">CHANGE</label>
                            <input type="number" id="change" name="change" disabled title="Change" placeholder="0" class="w-full px-2 rounded-r-md border-gray-300 bg-gray-100 shadow-md text-red-500 placeholder:text-red-500">
                        </div>

                        <div>
                            <label for="Discount" class="font-semibold text-xs">%&nbsp;DISCOUNT</label>
                            <input type="text" id="discount" name="discount" title="Discount" placeholder="0" maxlength="5" class="w-full rounded-l-md border-gray-400 shadow-md text-green-600 myInput placeholder:text-green-500">
                        </div>

                        <div>
                            <label for="Discounted amount" class="font-semibold text-xs">DISCOUNTED</label>
                            <input type="number" id="discountamount" name="discountamount" disabled title="Discount amount" placeholder="0" class="w-full rounded-r-md border-gray-300 bg-gray-100 shadow-md text-red-500 placeholder:text-red-500">
                        </div>
                    </div>

                    <div class="flex items-center justify-center gap-3 mb-1 px-2">
                        <div class="grid grid-cols-3 gap-3">
                            <div>
                                <label class="font-semibold text-xs">CUSTOMER</label>
                                <input type="text" id="customer" name="customer" title="Customer name" placeholder="Name | Table no." maxlength="20" class="w-full rounded-md border-gray-400 shadow-md">
                            </div>

                            <div>
                                <label for="Note" class="font-semibold text-xs">NOTE</label>
                                <textarea type="text" name="" id="note" cols="30" title="Special Request" rows="1" maxlength="75" placeholder="Any..." style="height: 41px;" class="w-full rounded-md overflow-y-hidden w-full border-gray-400 shadow-md"></textarea>
                            </div>

                            <div>
                                <label for="Note" class="font-semibold text-xs">Add-ons</label>
                                <input type="hidden"id="order_id">
                                <div class="flex">
                                    <input type="text" id="add-ons-to" placeholder="Ref no." class="w-full rounded-l-full border-gray-400 shadow-md px-1">
                                    <button id="add-ons" class="indicator w-full text-xl border rounded-r-full border-gray-500 hover:border-gray-50 px-2 ml-1 text-center bg-gradient-to-r from-red-500 to-gray-700 text-white hover:text-red-200">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 ml-2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center justify-left" data-drawer-hide="drawer-backdrop" aria-controls="drawer-backdrop">
                        <div class="flex ml-2">
                            <div>
                                <label for="Service type" class="font-semibold text-xs">SERVICE</label>
                                <div class="flex items-center hover:cursor-pointer">
                                    <input id="horizontal-list-radio-license" checked type="radio" value="DN" title="Dine in" name="service" title="Dine in" class="form-check-input appearance-none rounded-full h-4 w-4 border border-gray-300 bg-white checked:bg-rose-600 checked:border-rose-600 focus:outline-none transition duration-200 align-top bg-no-repeat bg-center bg-contain float-left cursor-pointer">
                                    <label for="horizontal-list-radio-license" title="Dine in" class="px-2 text-base font-bold text-gray-900 dark:text-gray-800 hover:cursor-pointer">DN</label>
                                </div>
                            </div>

                            <div class="mt-4">
                                <div class="flex items-center hover:cursor-pointer">
                                    <input id="horizontal-list-radio-passport" type="radio" value="TK" name="service" title="Take out" class="form-check-input appearance-none rounded-full h-4 w-4 border border-gray-300 bg-white checked:bg-rose-600 checked:border-rose-600 focus:outline-none transition duration-200 cursor-pointer">
                                    <label for="horizontal-list-radio-passport" title="Take out" class="font p-2 text-base font-bold text-gray-900 dark:text-gray-800 hover:cursor-pointer">TK</label>
                                </div>
                            </div>
                        </div>

                        <button id="refresh-table" title="Refresh | Cancel Order" class="ml-auto border border-gray-500 rounded-full hover:border-gray-50 mt-4 text-white font-medium hover:text-red-300 p-1 bg-gradient-to-r from-red-500 to-gray-700 rounded-full mr-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
                            </svg>
                        </button>

                        <!-- print receipt -->
                        <button id="print-receipt" title="print receipt" class="ml-auto border rounded-md border-gray-500 hover:border-gray-50 rounded-md mt-4 flex px-3 py-2 bg-gradient-to-r from-red-500 to-gray-700 text-white hover:text-red-200">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0110.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0l.229 2.523a1.125 1.125 0 01-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0021 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 00-1.913-.247M6.34 18H5.25A2.25 2.25 0 013 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 011.913-.247m10.5 0a48.536 48.536 0 00-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5zm-3 0h.008v.008H15V10.5z" />
                            </svg>
                            &nbsp; Print
                        </button>

                        <!-- place order -->
                        <button id="send-request" title="Place order" class="hidden ml-auto border rounded-md border-gray-500 hover:border-gray-50 rounded-md mt-4 flex px-3 py-2 mr-2 bg-gradient-to-r from-red-500 to-gray-700 text-white hover:text-red-200">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0M10.5 8.25h3l-3 4.5h3" />
                            </svg>
                            &nbsp; Place
                        </button>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

<!-- KEYPAD -->
<div id="drawer-backdrop" class="fixed top-0 mt-44 left-0 z-50 h-72 px-4 pt-4 overflow-y-auto transition-transform -translate-x-full bg-sky-500/[.50] w-80 shadow-md rounded-r" tabindex="-1" aria-labelledby="drawer-backdrop-label">
    <h5 id="drawer-backdrop-label" class="flex text-base font-semibold text-gray-100 uppercase">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z" />
        </svg>
    </h5>
    <button type="button" data-drawer-hide="drawer-backdrop" aria-controls="drawer-backdrop" class="text-gray-100 bg-transparent hover:text-gray-900 rounded-lg text-sm p-1.5 absolute top-2.5 right-2.5 inline-flex items-center ">
        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
        </svg>
        <span class="sr-only">Close keypad</span>
    </button>
    <div class="py-3 px-2 overflow-y-auto">
        <div class="keypad grid grid-cols-3 gap-4 font-medium">
            <button class="key font-bold bg-gray-50 border border-gray-500 hover:border-gray-400 hover:text-gray-400 rounded-md py-2 px-4 shadow-xl">7</button>
            <button class="key font-bold bg-gray-50 border border-gray-500 hover:border-gray-400 hover:text-gray-400 rounded-md py-2 px-4 shadow-xl">8</button>
            <button class="key font-bold bg-gray-50 border border-gray-500 hover:border-gray-400 hover:text-gray-400 rounded-md py-2 px-4 shadow-xl">9</button>
            <button class="key font-bold bg-gray-50 border border-gray-500 hover:border-gray-400 hover:text-gray-400 rounded-md py-2 px-4 shadow-xl">4</button>
            <button class="key font-bold bg-gray-50 border border-gray-500 hover:border-gray-400 hover:text-gray-400 rounded-md py-2 px-4 shadow-xl">5</button>
            <button class="key font-bold bg-gray-50 border border-gray-500 hover:border-gray-400 hover:text-gray-400 rounded-md py-2 px-4 shadow-xl">6</button>
            <button class="key font-bold bg-gray-50 border border-gray-500 hover:border-gray-400 hover:text-gray-400 rounded-md py-2 px-4 shadow-xl">1</button>
            <button class="key font-bold bg-gray-50 border border-gray-500 hover:border-gray-400 hover:text-gray-400 rounded-md py-2 px-4 shadow-xl">2</button>
            <button class="key font-bold bg-gray-50 border border-gray-500 hover:border-gray-400 hover:text-gray-400 rounded-md py-2 px-4 shadow-xl">3</button>
            <button class="key font-bold bg-gray-50 border border-gray-500 hover:border-gray-400 hover:text-gray-400 rounded-md py-2 px-4 shadow-xl">.</button>
            <button class="key font-bold bg-gray-50 border border-gray-500 hover:border-gray-400 hover:text-gray-400 rounded-md py-2 px-4 shadow-xl">0</button>
            <button id="backspace" class="bg-gray-50 border border-gray-500 hover:border-gray-400 hover:text-gray-400 rounded-md py-2 px-4 shadow-xl">Del</button>
        </div>
    </div>
</div>

<script src="public/assets/js/menu.js"></script>