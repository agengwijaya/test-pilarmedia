<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

// ini_set('max_execution_time', 180);
class DashboardControler extends Controller
{
    public function index(Request $request)
    {
        $tgl_awal = !empty($request->tgl_awal) ? $request->tgl_awal : date('Y-m-01');
        $tgl_akhir = !empty($request->tgl_akhir) ? $request->tgl_akhir : date('Y-m-d');

        // $penjualan_sales = DB::table('sales_people as a')
        //     ->leftJoin('sales as b', 'b.sales_person_id', 'a.id')
        //     ->whereBetween('b.tanggal_transaksi', [$tgl_awal, $tgl_akhir])
        //     ->where('a.soft_delete', 0)
        //     ->select(
        //         'a.nama as sales',
        //         'b.*'
        //     )
        //     ->paginate(10);

        $penjualan_sales = DB::table('sales_people as a')
            ->where('a.soft_delete', 0)
            ->paginate(2);

        $set = [
            'tgl_awal' => $tgl_awal,
            'tgl_akhir' => $tgl_akhir,
            'penjualan_sales' => $penjualan_sales,
        ];

        return view('dashboard.index', $set);
    }
}
