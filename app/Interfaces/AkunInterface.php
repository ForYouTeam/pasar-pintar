<?php

namespace App\Interfaces;

interface AkunInterface
{
  public function getAllPayload(array $meta);
  public function upsertPayload($id, array $payload);
  public function getPayloadById($id);
  public function deletePayload($id);
}