<?php

namespace App\Interfaces;

interface MenuInterface
{
    public function getdata();
    public function storedata($request);
    public function updatedata($request, $id);
    public function deletedata($id);

}
