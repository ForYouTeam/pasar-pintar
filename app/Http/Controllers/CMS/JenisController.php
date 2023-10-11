<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Http\Requests\JenisRequest;
use App\Interfaces\JenisInterface;
use Illuminate\Http\Request;

class JenisController extends Controller
{
	private JenisInterface $jenisRepo;

	public function __construct(JenisInterface $jenisRepo)
	{
		$this->jenisRepo = $jenisRepo;
	}

	public function index()
	{
		$data = $this->jenisRepo->getAllPayload();
		return view('Pages.Jenis')->with('data', $data['data']);
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

	public function upsertPayloadData(JenisRequest $request)
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
