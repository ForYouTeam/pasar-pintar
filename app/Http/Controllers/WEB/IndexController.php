<?php

namespace App\Http\Controllers\WEB;

use App\Http\Controllers\Controller;
use App\Models\HewanModel;
use App\Models\ProfileModel;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function indexView()
    {
        $data = HewanModel::joinList()->get();
        $profil = ProfileModel::all();
        return view('web.index')->with([
            'data'   => $data,
            'profil' => $profil
        ]);
    }

    public function pesanan($noHp)
    {
        return view('web.pesanan')->with('no_hp', $noHp);
    }
}