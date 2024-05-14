<?php

namespace App\Http\Controllers\OOP;

use App\Http\Controllers\Controller;
use Buku;
use Illuminate\Http\Request;
include 'Buku.php';

class OopControler extends Controller
{
    public function index()
    {
        $buku = new Buku('PHP Laravel', 100000, 'Ageng Wijaya');

        $set = [
            'buku' => $buku->getInfo(),
        ];

        return view('oop.index', $set);
    }
}
