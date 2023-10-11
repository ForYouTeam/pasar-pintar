<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Models\HewanModel;
use App\Models\JenisModel;
use App\Models\ProfileModel;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'profil' => ProfileModel::count(),
            'user' => User::count(),
            'jenis' => JenisModel::count(),
            'hewan' => HewanModel::count(),
        ]; 
        
        return view('Pages.Dashboard')->with('data', $data);
    }
}
