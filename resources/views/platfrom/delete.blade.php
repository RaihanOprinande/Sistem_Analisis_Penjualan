{{-- filepath: /d:/COOLYEAH/Semester 6/Millenial Technologi/pos/resources/views/data_component/modal_delete.blade.php --}}
<div id="delete-modal" tabindex="-1" aria-hidden="true"
    class="hidden fixed inset-0 z-50 flex items-center justify-center bg-gray-800/80 bg-opacity-80">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
            <!-- Modal header -->
            <div
                class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Delete Platfrom
                </h3>
                <button type="button" onclick="closeDelete()"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-toggle="delete-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <form class="p-4 md:p-5" method="POST">
                @method('DELETE')
                @csrf
                <input type="hidden" id="delete-id" name="id">
                <p class="text-md text-gray-500 dark:text-white">
                    Are you sure you want to delete this Platfrom?
                </p>
                <div class="flex justify-end mt-5">
                    <button type="button"
                        class="text-gray-500 bg-gray-500 hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 mr-2 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:bg-gray-600 hover:text-black dark:hover:border-gray-600 dark:focus:ring-gray-600"
                        data-modal-toggle="delete-modal" onclick="closeDelete()">
                        Cancel
                    </button>
                    <button type="submit"
                        class="text-white hover:text-black bg-red-600 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg mr-3 text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                        Delete
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function closeDelete() {
        document.getElementById('delete-modal').classList.add('hidden');
    }

    // Event listener untuk menutup modal dengan tombol Esc
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            closeDelete();
        }
    });
</script>
