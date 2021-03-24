<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BarangModel;

class BarangController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if(auth()->check()){
            return redirect('/dashboard');
          }else{
            return redirect('/login');
          }

    }

    public function dashboard()
    {
        $dataPoints = array();

        $barangs = BarangModel::select('NamaBarang', 'Stok')->get();
        foreach ($barangs as $barang) {
            $point = array("y" => $barang->Stok, "label" => $barang->NamaBarang);
            array_push($dataPoints, $point);     
        }

        return view('dashboard', compact('dataPoints'));
    }
}
