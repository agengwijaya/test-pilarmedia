<?php

namespace App\Http\Controllers\Dropdown;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DropdownControler extends Controller
{
    public function index()
    {
        return view('dropdown.index');
    }
}
