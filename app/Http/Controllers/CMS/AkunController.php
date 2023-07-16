<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Http\Requests\AkunRequest;
use App\Interfaces\AkunInterface;
use Illuminate\Http\Request;

class AkunController extends Controller
{
    private AkunInterface $akunRepo;
    public function __construct(AkunInterface $akunRepo)
    {
        $this->akunRepo = $akunRepo;
    }

    public function index()
    {
        $data = $this->akunRepo->getAllPayload([]);
        return view('Pages.Akun')->with('data', $data['data']);
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
            "level" => 'admin',
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
