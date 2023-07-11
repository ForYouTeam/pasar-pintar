<?php

namespace App\Interfaces;

interface ProfileInterface {
  public function getAllPayload();
  public function deletePayload($id);
  public function getPayloadById($id);
  public function upsertPayload($id, array $payload);
}