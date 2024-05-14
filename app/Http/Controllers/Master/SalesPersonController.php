<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\SalesPerson;
use Illuminate\Http\Request;

class SalesPersonController extends Controller
{
    public function index()
    {
        $sales_person = SalesPerson::where('soft_delete', 0)->get();

        $set = [
            'sales_person' => $sales_person
        ];

        return view('master.sales_person.index', $set);
    }

    public function store(Request $request)
    {
        $data = [
            'nama' => $request->nama,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat ?? '-',
            'created_by' => auth()->user()->id
        ];

        SalesPerson::create($data);

        return back();
    }

    public function update(Request $request, $id)
    {
        $data = [
            'nama' => $request->nama,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat ?? '-',
            'updated_by' => auth()->user()->id
        ];

        SalesPerson::where('id', $id)->update($data);

        return back();
    }

    public function destroy($id)
    {
        $data = [
            'soft_delete' => 1,
            'deleted_at' => date('Y-m-d H:i:s'),
            'deleted_by' => auth()->user()->id
        ];

        SalesPerson::where('id', $id)->update($data);

        return back();
    }
}
