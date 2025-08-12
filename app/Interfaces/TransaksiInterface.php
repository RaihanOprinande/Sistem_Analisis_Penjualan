<?php

namespace App\Interfaces;

interface TransaksiInterface
{
    public function getallTransaksi();
    public function getallmenu();
    public function getallplatfrom();
    public function store($request);

}
