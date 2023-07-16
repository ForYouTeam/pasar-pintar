<?php

namespace App\Repositories;

use App\Interfaces\AkunInterface;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class AkunRepository implements AkunInterface
{
  private User $akunModel;
  public function __construct(User $akunModel)
  {
    $this->akunModel = $akunModel;
  }

  public function getAllPayload(array $meta)
  {
    try {
      $data = $this->akunModel->where('level', 'admin')->orderBy('created_at', 'desc')->get();

      $payloadList = array(
        "message" => "Berhasil mengambil data",
        "code"    => 200,
        "icon"    => 'success',
        "data"    => $data
      );
    } catch (\Throwable $th) {
      $payloadList = array(
        'message' => $th->getMessage(),
        'code'    => 500,
        'icon'    => 'error',
        'from'    => "jabatan get all"
      );
    }

    return $payloadList;
  }

  public function upsertPayload($id, array $payload)
  {
    try {
      $date = Carbon::now();
      $hash = Hash::make($payload['password']);

      if ($id) {

        $findData = $this->getPayloadById($id);
        if ($findData['code'] == 404) {
          return $findData;
        }

        if ($findData['data']['level'] == 'super-admin') {
          return array(
            'message' => "Data tidak ditemukan",
            'code'    => 404
          );
        }

        $payload['updated_at'] = $date;
        $payload['password'] = $hash;

        $data    = $this->akunModel->whereId($id)->update($payload);
        $message = "Data berhasil perbaharui";
      } else {

        $payload['created_at'] = $date;
        $payload['updated_at'] = $date;
        $payload['password'] = $hash;

        $data    = $this->akunModel->create($payload);
        $message = "Data berhasil dibuat";

        $data->assignRole('admin');
      }

      $payloadList = array(
        "message" => $message,
        "code"    => 200,
        "icon"    => 'success',
        "data"    => $data
      );
    } catch (\Throwable $th) {
      $payloadList = array(
        'message' => $th->getMessage(),
        'code'    => 500,
        'icon'    => 'error',
        'from'    => "user upsert"
      );
    }

    return $payloadList;
  }

  public function getPayloadById($id)
  {
    try {
      $data = $this->akunModel->whereId($id)->orderBy('created_at', 'desc')->first();

      if (!$data) {
        $message = "Data tidak ditemukan";
        $code    = 404;
        $icon    = 'info';
      } else {
        $message = "Data berhasil ditemukan";
        $code    = 200;
        $icon    = 'success';
      }

      $payloadList = array(
        "message" => $message,
        "code"    => $code,
        "icon"    => $icon,
        "data"    => $data
      );
    } catch (\Throwable $th) {
      $payloadList = array(
        'message' => $th->getMessage(),
        'code'    => 500,
        'icon'    => 'error',
        'from'    => "jabatan get by id"
      );
    }

    return $payloadList;
  }

  public function deletePayload($id)
  {
    try {
      $data = $this->akunModel->whereId($id);

      if (!$data->first()) {
        $message = "Data tidak ditemukan";
        $code    = 404;
        $icon    = 'info';
      } else {
        $message = "Data berhasil dihapus";
        $code    = 200;
        $icon    = 'success';
      }

      $payloadList = array(
        "message" => $message,
        "code"    => $code,
        "icon"    => $icon,
        "data"    => $data->delete()
      );
    } catch (\Throwable $th) {
      $payloadList = array(
        'message' => $th->getMessage(),
        'code'    => 500,
        'icon'    => 'error',
        'from'    => "jabatan delete"
      );
    }

    return $payloadList;
  }
}