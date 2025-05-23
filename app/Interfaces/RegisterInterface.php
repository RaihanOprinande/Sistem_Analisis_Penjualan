<?php

namespace App\Interfaces;

use Illuminate\Http\Request;

interface RegisterInterface
{
    public function store(Request $request);
}
