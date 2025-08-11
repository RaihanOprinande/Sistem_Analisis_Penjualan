<?php

namespace App\Interfaces;

use Illuminate\Http\Request;

interface PlatfromInterface
{
    public function getdata(Request $request);
    public function storedata(Request $request);
    public function updatedata(Request $request, $id);
    public function deletedata($id);
    public function showdata($id);
    public function showdatakomisi($id);
}
