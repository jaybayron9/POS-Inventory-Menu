<?php if (Auth::isAdmin()) { ?>

<section class="p-6 text-gray-50 container flex flex-col mx-auto space-y-12">
    <form id="settings" class="bg-gray-100 rounded-md shadow-sm" style="background-image: url('public/storage/eximage/bg3.png'); background-size: 20px 20px;">
        <input type="hidden" name="id" value="<?= Settings::settings('id') ?>">
        <fieldset class="grid grid-cols-4 gap-6 p-6 rounded-md bg-gray-100" style="background-image: url('public/storage/eximage/bg3.png'); background-size: 20px 20px;">
            <div class="space-y-2 col-span-full lg:col-span-1">
                <p class="font-bold text-gray-900">POS Settings</p>
                <!-- <p class="text-xs"></p> -->
            </div>
            <div class="grid grid-cols-6 gap-4 col-span-full lg:col-span-3">
                <div class="col-span-full sm:col-span-3">
                    <label for="Bussiness Name" class="font-semibold text-sm text-gray-700">Bussiness Name</label>
                    <input id="username" type="text" name="business_name" placeholder="HotPlate Sizzling House" value="<?= Settings::settings('bussiness_name') ?>" class="bg-gray-50 border text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                </div>
                <div class="col-span-full sm:col-span-3">
                    <label for="Bussiness Name" class="font-semibold text-sm text-gray-700">Address</label>
                    <input id="username" type="text" name="business_address" placeholder="1149 Marcelo H. Del Pilar, Corner Cordero St Arkong Bato, Valenzuela, 1444 Metro Manila Valenzuela, Philippines" value="<?= Settings::settings('address') ?>" class="bg-gray-50 border text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                </div>
                <div class="col-span-full sm:col-span-3">
                    <label for="Phone No." class="font-semibold text-sm text-gray-700">Phone No.</label>
                    <input id="username" type="text" name="business_phone" placeholder="+92 26-306-5035" value="<?= Settings::settings('contact_no') ?>" class="bg-gray-50 border text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                </div>
                <div class="col-span-full sm:col-span-3">
                    <label for="email" class="font-semibold text-sm text-gray-700">Email</label>
                    <input id="email" type="email" name="business_email" placeholder="hotplate@gmail.com" value="<?= Settings::settings('email') ?>" class="bg-gray-50 border text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                </div>
                <div class="col-span-full sm:col-span-3">
                    <label for="email" class="font-semibold text-sm text-gray-700">Facebook URL</label>
                    <input id="email" type="text" name="business_fb" placeholder="fb.com/hotplatesizzling" value="<?= Settings::settings('URL') ?>" class="bg-gray-50 border text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                </div>
                <div class="col-span-full sm:col-span-3">
                    <label for="Business logo" class="font-semibold text-sm text-gray-700">Business logo</label>
                    <div class="flex items-center space-x-2">
                        <img src="public/storage/eximage/<?= Settings::settings('logo') !== Null ? Settings::settings('logo') : 'icon.jpg' ?>" alt="" class="w-10 h-10 rounded-full bg-gray-200 p-1">
                        <input type="file" name="image" class="bg-gray-50 border border-gray-600 text-gray-900 text-sm rounded-lg block w-full">
                    </div>
                </div>
            </div>
        </fieldset>
        <div class="flex">
            <button type="submit" class="ml-auto mb-5 mr-6 px-4 py-2 border rounded-md border-gray-500 bg-gradient-to-r from-red-500 to-gray-700 text-white hover:text-red-200 rounded-md shadow-md hover:border-gray-50">Save</button>
        </div>
    </form>
</section>


<script>
    $(document).ready(function() {
        $('#settings').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                url: 'index.php?t=update_settings',
                type: 'POST',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function(data) {
                    alert(data);
                },
            });
        });
    });
</script>

<?php } else {
?>
    <div class="flex justify-center items-center">
        <h1 class="mt-20 text-2xl font-bold text-gray-500">Unauthorized User</h1>
    </div>
<?php
} ?>