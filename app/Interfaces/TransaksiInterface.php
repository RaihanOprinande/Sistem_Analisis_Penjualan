<?php

namespace App\Interfaces;

interface TransaksiInterface
{
    public function getAllTransaksi();
    public function getTransaksiById($id);
    public function createTransaksi(array $data);
    public function updateTransaksi($id, array $data);
    public function deleteTransaksi($id);
    public function getTransaksiByDateRange($startDate, $endDate);
    public function getTransaksiByPlatform($platformId);
    public function getTransaksiByMenu($menuId);
    public function getTransaksiByKomisi($komisiId);
}
