<?php

namespace App\Interfaces;

interface CommissionInterface
{
    public function getdata();
    public function getdetail($id);
    public function getdetailplatfrom($id);
    public function storedata($request);
    public function updatedata($request, $id);
    public function deletedata($id);
}
