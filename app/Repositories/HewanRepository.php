<?php

namespace App\Repositories;

use App\Interfaces\HewanInterface;
use App\Models\HewanModel;
use Carbon\Carbon;

class HewanRepository implements HewanInterface {
  
  private HewanModel $jenisModel;

  public function __construct(HewanModel $jenisModel)
  {
    $this->jenisModel = $jenisModel;
  }

  public function getAllPayload()
  {
    try {
      $payloadList = array(
        'message' => 'Berhasil mengambil data',
        'code'    => 200,
        'data'    => $this->jenisModel->joinList()->get()
      );
    } catch (\Throwable $th) {
      $payloadList = array(
        'message' => $th->getMessage(),
        'code'    => 500
      );
    }

    return $payloadList;
  }

  public function getPayloadById($id)
  {
    try {
      $data = $this->jenisModel->whereId($id)->first();

      if ($data) {
        $payloadList = array(
          'message' => 'Berhasil mengambil Id',
          'code'    => 200,
          'data'    => $data
        );
      } else {
        $payloadList = array(
          'message' => 'not found',
          'code'    => 404,
        );
      }
    } catch (\Throwable $th) {
      $payloadList = array(
        'message' => $th->getMessage(),
        'code'    => 500
      );
    }

    return $payloadList;
  }

  public function upsertPayload($id, array $payload)
  {
    try {
      $date = Carbon::now();
      if ($id) {
        $status = $this->getPayloadById($id);
        
        if ($status['code'] == 200) {
          $payload['updated_at'] = $date;

          $payloadList = array(
            'message' => 'Data berhasil diperbaruhi',
            'code'    => 200,
            'data'    => $this->jenisModel->whereId($id)->update($payload)
          );
        } else {
          $payloadList = $status;
        }
        
      } else {
        $payload['created_at'] = $date;
        $payload['updated_at'] = $date;

        $payloadList = array(
          'message' => 'Data berhasil ditambahkan',
          'code'    => 200,
          'data'    => $this->jenisModel->create($payload)
        );
      }
      
    } catch (\Throwable $th) {
      $payloadList = array(
        'message' => $th->getMessage(),
        'code'    => 500
      );
    }

    return $payloadList;
  }

  public function deletePayload($id)
  {
    try {
      
      $data = $this->getPayloadById($id);
      if ($data['code'] == 200) {
        $payloadList = array(
          'message' => 'Data berhasil dihapus',
          'code'    => 200,
          'data'    => $this->jenisModel->whereId($id)->delete()
        );
      } else {
        $payloadList = $data;
      }
      
    } catch (\Throwable $th) {
      $payloadList = array(
        'message' => $th->getMessage(),
        'code'    => 500
      );
    }
    
    return $payloadList;
  }

}