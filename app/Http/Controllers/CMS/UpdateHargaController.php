<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Http\Requests\HargaRequest;
use App\Interfaces\UpdateInterface;
use Illuminate\Http\Request;

class UpdateHargaController extends Controller
{
	private UpdateInterface $jenisRepo;

	public function __construct(UpdateInterface $jenisRepo)
	{
		$this->jenisRepo = $jenisRepo;
	}

	public function index()
	{
		$data = $this->jenisRepo->getAllPayload();
		return view('Pages.UpdateHarga')->with('data', $data['data']);
	}

	public function getPayloadData()
	{
		$payload = $this->jenisRepo->getAllPayload();
		return response()->json($payload, $payload['code']);
	}

	public function getPayloadDataId($id)
	{
		$payload = $this->jenisRepo->getPayloadById($id);

		return response()->json($payload, $payload['code']);
	}

	public function upsertPayloadData(HargaRequest $request)
	{
		$id = $request->id | null;
		$payload = $this->jenisRepo->upsertPayload($id, $request->except('_token'));

		return response()->json($payload, $payload['code']);
	}


	public function deletePayloadData($id)
	{
		$payload = $this->jenisRepo->deletePayload($id);

		return response()->json($payload, $payload['code']);
	}
}
