<?php

namespace App\Interfaces;

use Illuminate\Http\Request;

interface RegisterInterface
{
    public function store(Request $request);
    public function getalldata();
    public function deletedata($id);
    public function updatedata($request, $id);
}
