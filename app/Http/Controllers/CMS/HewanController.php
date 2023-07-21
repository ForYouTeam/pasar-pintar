<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Http\Requests\HewanRequest;
use App\Interfaces\HewanInterface;
use App\Interfaces\JenisInterface;
use App\Interfaces\ProfileInterface;
use App\Interfaces\UpdateInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class HewanController extends Controller
{
	private HewanInterface $hewanRepo;
	private JenisInterface $jenisRepo;
	private UpdateInterface $updateRepo;
	private ProfileInterface $profileRepo;

	public function __construct(HewanInterface $hewanRepo, JenisInterface $jenisRepo, UpdateInterface $updateRepo, ProfileInterface $profileRepo)
	{
		$this->hewanRepo = $hewanRepo;
		$this->jenisRepo = $jenisRepo;
		$this->updateRepo = $updateRepo;
		$this->profileRepo = $profileRepo;
	}

	public function index()
	{
		$update = $this->updateRepo->getAllPayload([]);
		$jenis  = $this->jenisRepo->getAllPayload([]);
		$data   = $this->hewanRepo->getAllPayload([]);
		$profil = $this->profileRepo->getAllPayload([]);
		return view('Pages.Hewan')->with([
			'data'   => $data  ['data'],
			'jenis'  => $jenis ['data'],
			'update' => $update['data'],
			'profil' => $profil['data']
		]);
	}

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

	public function upsertPayloadData(HewanRequest $request)
	{
		$date = Carbon::now();
		$fileUpload = $request->file('path');
		$nameFile = 'photo' . '_' . $date . '.' . $fileUpload->getClientOriginalExtension();

		$data = $request->except('_token');
		$data['path'] = $nameFile;

		$id = $request->id | null;
		$payload = $this->hewanRepo->upsertPayload($id, $data);

		if ($payload) {

			$filePath = public_path('storage/gambar/');
			$fileUpload->move($filePath, $nameFile);
		}

		return response()->json($payload, $payload['code']);
	}


	public function deletePayloadData($id)
	{
		$data = $this->hewanRepo->getPayloadById($id);
		$payload = $this->hewanRepo->deletePayload($id);
		$foto = $data['data']['path'];

		File::delete(public_path('storage/gambar/' . $foto));

		return response()->json($payload, $payload['code']);
	}
}
