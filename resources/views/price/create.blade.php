@extends('layouts.main')
@section('content')
    <style>
        /* Ubah tinggi select2 */
        .select2-container .select2-selection--single {
            height: 44px !important;
            /* ganti sesuai kebutuhan, misal 44px */
            display: flex;
            align-items: center;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 44px !important;
            /* samakan dengan height di atas */
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 44px !important;
        }
    </style>
    <div class="alert mx-auto" id="alert-box mb-2">
        @if ($message = Session::get('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-gray-800 p-4" role="alert">
                <p class="font-bold">Success</p>
                <p>{{ $message }}</p>
            </div>
        @elseif($message = Session::get('error'))
            <div class="bg-red-100 border-l-4 border-red-500 text-gray-800 p-4" role="alert">
                <p class="font-bold">Oops!</p>
                <p>{{ $message }}</p>
            </div>
        @endif
    </div>
    <h1 class="text-4xl font-bold mb-10">Add new Price</h1>
    <form action="/price/store" method="POST">
        @csrf
        <div class="platfrom mb-5">
            <div class="from-neutral-800 text-base mb-1" for="platfrom_id">Select Platfrom</div>
            <select class="js-example-basic-single w-full " name="platfrom_id" id="platfrom_id">
                <option value="">Select Platfrom</option>
                @foreach ($platfrom as $item)
                    <option value="{{ $item->id }}">{{ $item->platfrom }}</option>
                @endforeach
            </select>
        </div>

        <div class="platfrom mb-5">
            <div class="from-neutral-800 text-base mb-1" for="komisi">Percentage Platfrom Comission</div>
            <select class="js-example-basic-single w-full " name="komisi_id" id="komisi">
                <option value="">Select Commission</option>
                @foreach ($komisi as $item)
                    <option value="{{ $item->id }}">{{ $item->komisi }}%</option>
                @endforeach
            </select>
        </div>

        <div class="menu mb-5">
            <div class="from-neutral-800 text-base mb-1" for="platfrom_id">Select Menu</div>
            <select class="js-example-basic-single w-full" name="menu_id" id="menu_id">
                <option value="">Select Menu</option>
                @foreach ($menu as $item)
                    <option value="{{ $item->id }}" data-hpp="{{ $item->hpp }}">{{ $item->menu_name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-5">
            <div for="hpp" class="from-neutral-800 text-base mb-1">HPP From Menu</div>
            <input type="number" name="hpp" id="hpp"
                class=" border text-sm rounded-sm focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5   dark:focus:ring-primary-500 dark:focus:border-primary-500"
                placeholder="" required="" readonly>
        </div>

        <div class="mb-5">
            <div for="target_laba" class="from-neutral-800 text-base mb-1">Percentage Profit</div>
            <input type="number" name="target_laba" id="target_laba"
                class=" border text-sm rounded-sm focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5   dark:focus:ring-primary-500 dark:focus:border-primary-500"
                placeholder="30" required="">
        </div>



        <div class="mb-5">
            <div for="rekomendasi_harga" class="from-neutral-800 text-base mb-1">Recommended Price</div>
            <input type="number" name="harga_rekomendasi" id="rekomendasi"
                class=" border text-sm rounded-sm focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5   dark:focus:ring-primary-500 dark:focus:border-primary-500"
                placeholder="" required="" readonly>
        </div>

        <div class="mb-10">
            <div for="rekomendasi_harga" class="from-neutral-800 text-base mb-1">Your Price</div>
            <input type="number" name="harga" id="rekomendasis"
                class=" border text-sm rounded-sm focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5   dark:focus:ring-primary-500 dark:focus:border-primary-500"
                placeholder="" required="">
        </div>
        <button type="submit"
            class="text-white inline-flex mb-10 items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mt-1 text-center col-span-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                    d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                    clip-rule="evenodd"></path>
            </svg>
            Add new price
        </button>
    </form>

    <script>
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
            $('#priceTable').DataTable();

            const prices = @json($price);
            const commissions = @json($komisi);

            $('#platfrom_id').on('change', function() {
                let platfromId = $(this).val();
                // Ambil semua menu_id yang sudah ada di price untuk platform ini
                let usedMenuIds = prices
                    .filter(item => item.platfrom_id == platfromId)
                    .map(item => item.menu_id);

                let selectedCommission = commissions.find(item => item.platfrom_id == platfromId);
                if (selectedCommission) {
                    $('#komisi').val(selectedCommission.id).trigger('change');
                } else {
                    $('#komisi').val('').trigger('change');
                }

                // Tampilkan hanya menu yang belum ada di price untuk platform ini
                $('#menu_id option').each(function() {
                    if (!$(this).val()) return; // skip option kosong
                    if (usedMenuIds.includes(parseInt($(this).val()))) {
                        $(this).hide();
                    } else {
                        $(this).show();
                    }
                });

                // Reset pilihan menu
                $('#menu_id').val('').trigger('change');
            });

            $('#menu_id').on('change', function() {
                let selected = this.options[this.selectedIndex];
                window.selectedHpp = parseFloat(selected.getAttribute('data-hpp')) || 0;
                $('#hpp').val(window.selectedHpp).toLocaleString('id-ID');
                hitungRekomendasi();
            });

            $('#target_laba').on('input', hitungRekomendasi);
            $('#komisi').on('input', hitungRekomendasi);

            function hitungRekomendasi() {
                let hpp = parseFloat(window.selectedHpp) || 0;
                let targetLaba = parseFloat($('#target_laba').val()) || 0;
                let komisi = parseFloat($('#komisi').val()) || 0;

                let rekomendasiHarga = (hpp + (hpp * (targetLaba / 100))) / (1 - (komisi / 100));
                $('#rekomendasi').val(rekomendasiHarga.toFixed(2));
            }

        });
    </script>
@endsection
