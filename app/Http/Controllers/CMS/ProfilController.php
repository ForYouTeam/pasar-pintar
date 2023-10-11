<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use App\Interfaces\ProfileInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProfilController extends Controller
{
	private ProfileInterface $profileRepo;

	public function __construct(ProfileInterface $profileRepo)
	{
		$this->profileRepo = $profileRepo;
	}

	public function index()
	{
		$data = $this->profileRepo->getAllPayload();
		return view('Pages.Profile')->with('data', $data['data']);
	}

	public function getPayloadData()
	{
		$payload = $this->profileRepo->getAllPayload();
		return response()->json($payload, $payload['code']);
	}

	public function getPayloadDataId($id)
	{
		$payload = $this->profileRepo->getPayloadById($id);

		return response()->json($payload, $payload['code']);
	}

	public function upsertPayloadData(ProfileRequest $request)
	{
		$date = Carbon::now();
		$fileUpload = $request->file('foto');
		$nameFile = 'photo' . '_' . $date . '.' . $fileUpload->getClientOriginalExtension();

		$data = $request->except('_token');
		$data['foto'] = $nameFile;

		$id = $request->id | null;
		$payload = $this->profileRepo->upsertPayload($id, $data);

		if ($payload) {

			$filePath = public_path('storage/gambar/');
			$fileUpload->move($filePath, $nameFile);
		}

		return response()->json($payload, $payload['code']);
	}


	public function deletePayloadData($id)
	{
		$data = $this->profileRepo->getPayloadById($id);
		$payload = $this->profileRepo->deletePayload($id);
		$foto = $data['data']['foto'];

		File::delete(public_path('storage/gambar/' . $foto));

		return response()->json($payload, $payload['code']);
	}
}
