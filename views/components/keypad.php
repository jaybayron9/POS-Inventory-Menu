<div id="keypad" class="absolute z-[100] top-20 left-10 bg-rose-600 p-3 rounded shadow-md sticky">
  <div class="grid grid-cols-3 gap-2">
    <button class="keypadbtn px-4 py-2 text-lg font-medium text-gray-800 bg-gray-200 rounded-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-400">1</button>
    <button class="keypadbtn px-4 py-2 text-lg font -medium text-gray-800 bg-gray-200 rounded-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-400">2</button>
    <button class="keypadbtn px-4 py-2 text-lg font-medium text-gray-800 bg-gray-200 rounded-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-400">3</button>
    <button class="keypadbtn px-4 py-2 text-lg font-medium text-gray-800 bg-gray-200 rounded-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-400">4</button>
    <button class="keypadbtn px-4 py-2 text-lg font-medium text-gray-800 bg-gray-200 rounded-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-400">5</button>
    <button class="keypadbtn px-4 py-2 text-lg font-medium text-gray-800 bg-gray-200 rounded-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-400">6</button>
    <button class="keypadbtn px-4 py-2 text-lg font-medium text-gray-800 bg-gray-200 rounded-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-400">7</button>
    <button class="keypadbtn px-4 py-2 text-lg font-medium text-gray-800 bg-gray-200 rounded-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-400">8</button>
    <button class="keypadbtn px-4 py-2 text-lg font-medium text-gray-800 bg-gray-200 rounded-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-400">9</button>
    <button class="keypadbtn px-4 py-2 text-lg font-medium text-gray-800 bg-gray-200 rounded-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-400">.</button>
    <button class="keypadbtn px-4 py-2 text-lg font-medium text-gray-800 bg-gray-200 rounded-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-400">0</button>
    <button class="keypadbtn px-4 py-2 text-lg font-medium text-gray-800 bg-gray-200 rounded-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-400">Del</button>
  </div>
</div>
<script>
  $(document).ready(function() {
    $('.myInput').click(function() {
      $('#keypad').toggleClass('hidden');
    });

    $('.keypadbtn').click(function() {
      var value = $(this).attr('id');
      var input = $('#myInput');
      var current = input.val();
      if (value == 'del') {
        input.val(current.substring(0, current.length - 1));
      } else {
        input.val(current + value);
      }
    });
  })
</script>