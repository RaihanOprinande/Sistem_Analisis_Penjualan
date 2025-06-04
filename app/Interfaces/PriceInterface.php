<?php

namespace App\Interfaces;

interface PriceInterface
{
    public function getallmenu();
    public function getmenubyplatfrom($id);
    public function getallprice();
    public function getallplatfrom();
    public function getdata($id);
    public function storedata($request);
    public function updatedata($request, $id);
    public function deletedata($id);
}
