<?php

namespace App\Imports;

use App\Models\Commission;
use App\Models\Menu;
use App\Models\Platfrom;
use App\Models\Transaksi;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class TransaksiImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $menu = Menu::where('menu_name', $row['menu'])->first();
        $platfrom = Platfrom::where('platfrom', $row['platfrom'])->first();

        if (!$platfrom || !$menu) {
            return null;
        }

        $komisi = Commission::where('platfrom_id', $platfrom->id)
                            ->orderBy('created_at', 'desc')
                            ->first();

        // --- Perbaikan di sini ---
        // Konversi tanggal dari format serial Excel
        try {
            $tanggal_transaksi = Date::excelToDateTimeObject($row['tanggal']);
        } catch (\Exception $e) {
            // Jika tanggal tidak valid (bukan angka), gunakan nilai aslinya
            $tanggal_transaksi = $row['tanggal'];
        }

        $harga_jual = $row['harga_jual'];
        $hpp = $menu->hpp;

        $omset = $row['jumlah_pesanan'] * $harga_jual;
        $laba_kotor = $omset - ($hpp * $row['jumlah_pesanan']);

        return new Transaksi([
            'tanggal_transaksi' => $tanggal_transaksi, // Gunakan variabel yang sudah dikonversi
            'platfrom_id' => $platfrom->id,
            'komisi_id' => $komisi->id ?? null,
            'menu_id' => $menu->id,
            'jumlah_pesanan' => $row['jumlah_pesanan'],
            'harga' => $harga_jual,
            'omset' => $omset,
            'laba_kotor' => $laba_kotor,
        ]);
    }
}
