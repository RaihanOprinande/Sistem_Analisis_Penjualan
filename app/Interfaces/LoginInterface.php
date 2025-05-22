<?php

namespace App\Interfaces;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Request;

interface LoginInterface
{
    public function authenticate(Request $request): RedirectResponse;
    public function logout(Request $request): RedirectResponse;
}
