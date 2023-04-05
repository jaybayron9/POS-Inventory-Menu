<!--Add-->
<div class="modal opacity-0 z-50 pointer-events-none fixed w-full h-full top-0 left-0 flex items-center justify-center">
    <div class="modal-overlay absolute w-full h-full bg-white opacity-95"></div>

    <div class="modal-container fixed w-full h-full z-50 overflow-y-auto">

        <div class="modal-close absolute top-0 right-0 cursor-pointer flex flex-col items-center mt-4 mr-4 text-black text-sm z-50">
            <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
            </svg>
            (Esc)
        </div>

        <!-- Add margin if you want to see grey behind the modal-->
        <div class="modal-content container mx-auto h-auto text-left p-4">

            <!--Title-->
            <div class="flex justify-between items-center pb-2">
                <p class="text-2xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-red-700 to-gray-900">HotPlate</p>
            </div>

            <!--Body-->
            <div class="flex items-center justify-center">
                <form id="product-form" enctype="multipart/form-data">
                    <input type="hidden" id="id" name="id" value="">
                    <h1 id="title-form" class="col-span-2 text-2xl font-semibold mb-2 text-center">Add Product</h1>
                    <div class="mb-2">
                        <label for="product" class="">Product Name</label>
                        <input type="text" name="product" id="product" class="w-full rounded-md">
                    </div>
                    <div class="mb-2">
                        <label for="Price">Price</label>
                        <input type="text" name="price" id="price" class="w-full rounded-md myInput">
                    </div>
                    <div class="mb-2">
                        <label for="category">Category</label>
                        <select type="text" name="category" id="category" class="w-full rounded-md">
                            <option value="meals">Meals</option>
                            <option value="drinks">Drinks</option>
                            <option value="add-ons">Add-ons</option>
                        </select>
                    </div>
                    <div class="mb-2">
                        <label for="description">Description</label>
                        <textarea name="description" id="description" cols="30" rows="1" class="w-full rounded-md p-2"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="Product image">Upload image</label>
                        <input type="file" name="image" id="" class="rounded-md bg-blue-300 w-full font-semibold">
                    </div>
                    <div class="mb-4">
                        <img id="img-con" src="" alt="product image" class="h-44 w-full rounded-md">
                    </div>
                    <!--Footer-->
                    <div class="col-span-2 flex justify-end pt-2 bottom-0">
                        <button id="savebtn" type="submit" class="savebtn px-4 bg-transparent p-3 rounded-lg text-blue-500 hover:bg-gray-100 hover:text-blue-400 mr-2">Save</button>
                        <button id="updatebtn" type="submit" class="updatebtn px-4 bg-transparent p-3 rounded-lg text-blue-500 hover:bg-gray-100 hover:text-blue-400 mr-2">Update</button>
                        <a href="#" class="modal-close px-4 bg-blue-500 p-3 rounded-lg text-white hover:bg-blue-400">Close</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#description').on('input', function() {
            $(this).height(0);
            $(this).height(this.scrollHeight);
        });

        $('#savebtn').click(function() {
            $("#product-form").submit(function(e) {
                e.preventDefault();
                $.ajax({
                    url: 'index.php?a=add_product',
                    type: 'POST',
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success: function(data) {
                        if (data.status == 'success') {
                            location.reload(true);
                        } else {
                            alert('Unable to save');
                        }
                    }
                });
            });
        });

        $('#updatebtn').click(function() {
            $("#product-form").submit(function(e) {
                e.preventDefault();
                $.ajax({
                    url: 'index.php?a=update_product',
                    type: 'POST',
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success: function(data) {
                        if (data.status == 'success') {
                            location.reload(true);
                        }
                    }
                });
            });
        });

        $('.myInput').on('keydown keyup', function(event) {
            var input = $(this);
            var value = input.val();

            value = value.replace(/[^0-9\.]/g, '');

            var decimalCount = (value.match(/\./g) || []).length;
            if (decimalCount > 1) {
                value = value.replace(/\.+$/, '');
            }

            input.val(value);
        });
    });
</script>