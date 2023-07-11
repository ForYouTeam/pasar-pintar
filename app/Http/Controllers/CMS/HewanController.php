<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Interfaces\HewanInterface;
use Illuminate\Http\Request;

class HewanController extends Controller
{
	private HewanInterface $hewanRepo;

	public function __construct(HewanInterface $hewanRepo)
	{
		$this->hewanRepo = $hewanRepo;
	}

	// public function getView()
	// {
	// 	$data = $this->hewanRepo->getAllPayload();
	// 	return view('pages.Jabatan')->with('data', $data['data']);
	// }

	public function getPayloadData()
	{
		$payload = $this->hewanRepo->getAllPayload();
		return response()->json($payload, $payload['code']);
	}

	public function getPayloadDataId($id)
	{
		$payload = $this->hewanRepo->getPayloadById($id);

		return response()->json($payload, $payload['code']);
	}

	public function upsertPayloadData(Request $request)
	{
		$id = $request->id | null;
		$payload = $this->hewanRepo->upsertPayload($id, $request->except('_token'));

		return response()->json($payload, $payload['code']);
	}


	public function deletePayloadData($id)
	{
		$payload = $this->hewanRepo->deletePayload($id);

		return response()->json($payload, $payload['code']);
	}
}
