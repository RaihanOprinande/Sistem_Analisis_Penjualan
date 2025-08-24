<?php

namespace Database\Factories;

use App\Models\Commission;
use App\Models\Menu;
use App\Models\Platfrom;
use App\Models\Price;
use App\Models\Transaksi;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaksi>
 */
class TransaksiFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    // protected $model = Transaksi::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
public function definition(): array
    {
        // 1. Ambil data acak dari model lain (Platfrom dan Menu)
        // Ini memastikan transaksi memiliki relasi yang valid
        $platfrom = Platfrom::inRandomOrder()->first() ?? Platfrom::factory()->create();
        $menu = Menu::inRandomOrder()->first() ?? Menu::factory()->create();

        // 2. Cari harga dan komisi yang sesuai dengan kombinasi menu dan platform
        $priceRecord = Price::where('platfrom_id', $platfrom->id)
                            ->where('menu_id', $menu->id)
                            ->first();

        // 3. Jika tidak ada harga yang ditemukan, buat data dummy baru
        if (!$priceRecord) {
            $priceRecord = Price::factory()->create([
                'platfrom_id' => $platfrom->id,
                'menu_id' => $menu->id,
            ]);
        }

        $komisiRecord = Commission::find($priceRecord->komisi_id) ?? Commission::factory()->create();

        // 4. Definisikan variabel untuk perhitungan
        $jumlah_pesanan = $this->faker->numberBetween(1, 20);
        $harga_jual = $priceRecord->harga;
        $hpp = $menu->hpp;

        // 5. Lakukan Perhitungan Otomatis
        $omset = $harga_jual * $jumlah_pesanan;

        // Asumsi laba kotor dihitung dari omset dikurangi total HPP
        $laba_kotor = $omset - ($hpp * $jumlah_pesanan);

        return [
            'platfrom_id' => $platfrom->id,
            'menu_id' => $menu->id,
            'komisi_id' => $komisiRecord->id,
            'tanggal_transaksi' => $this->faker->dateTimeBetween('2025-01-01', 'now'),
            'jumlah_pesanan' => $jumlah_pesanan,
            'harga' => $harga_jual,
            'omset' => $omset,
            'laba_kotor' => $laba_kotor,
        ];
    }
}
