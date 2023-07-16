<?php

namespace App\Http\Controllers\WEB;

use App\Http\Controllers\Controller;
use App\Models\HewanModel;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function indexView() {
        $data = HewanModel::all();
        return view('web.index')->with('data', $data);
    }
    public function pesanan() {
        return view('web.pesanan');
    }
}
