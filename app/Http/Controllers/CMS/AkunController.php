<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Http\Requests\AkunRequest;
use App\Interfaces\AkunInterface;
use App\Interfaces\ProfileInterface;
use Illuminate\Http\Request;

class AkunController extends Controller
{
    private AkunInterface $akunRepo;
    private ProfileInterface $profilRepo;
    public function __construct(AkunInterface $akunRepo, ProfileInterface $profilRepo)
    {
        $this->akunRepo = $akunRepo;
        $this->profilRepo = $profilRepo;
    }

    public function index()
    {
        $profil = $this->profilRepo->getAllPayload([]);
        $data = $this->akunRepo->getAllPayload([]);
        return view('Pages.Akun')->with([
            'data'   => $data['data'],
            'profil' => $profil['data'],
        ]);
    }

    public function getAllData()
    {
        $data = $this->akunRepo->getAllPayload([]);
        return response()->json($data, $data['code']);
    }

    public function upsertData(AkunRequest $request)
    {
        $id = $request->id | null;

        $payload = array(
            "nama"  => $request->nama,
            "username" => $request->username,
            "password" => $request->password,
            "profile_id" => $request->profile_id,
            "level" => 'admin'
        );

        $data = $this->akunRepo->upsertPayload($id, $payload);
        return response()->json($data, $data['code']);
    }

    public function getDataById($id)
    {
        $data = $this->akunRepo->getPayloadById($id);
        return response()->json($data, $data['code']);
    }

    public function deleteData($id)
    {
        $data = $this->akunRepo->deletePayload($id);
        return response()->json($data, $data['code']);
    }
}
