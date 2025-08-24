<?php

namespace App\Interfaces;

interface TransaksiInterface
{
    public function getallTransaksi($request);
    // public function getTransaksifiltered($request);
    public function getallmenu();
    public function update($request, $id);
    public function getallplatfrom();
    public function store($request);
    public function detailTransaction($year_month);
    public function cetakpdf($request);
    public function month();
    public function ringkasanbulan($request);
    public function ringkasanplatfrom($request);

}
