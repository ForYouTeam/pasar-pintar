<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HewanModel extends Model
{
    use HasFactory;
    protected $table = 'hewan';
    protected $fillable = [
        'nama_usaha' ,
        'jenis_id'   ,
        'berat'      ,
        'jk'         ,
        'usia'       ,
        'status'     ,
        'harga'      ,
        'harga_id'   ,
        'quantity'   ,
        'path'       ,
    ];

    public function scopejoinList($query)
    {
        return $query
            ->leftJoin('jenis as jenis_hewan', 'hewan.jenis_id', 'jenis_hewan.id')
            ->leftJoin('update_harga as perubahan', 'hewan.harga_id', 'perubahan.id')
            ->select(
                'hewan.id'                             ,
                'hewan.nama_usaha'                     ,
                'jenis_hewan.nama_jenis as nama_jenis' ,
                'hewan.berat'                          ,
                'hewan.jk'                             ,
                'hewan.usia'                           ,
                'hewan.status'                         ,
                'hewan.harga'                          ,
                'perubahan.code as code_hewan'         ,
                'perubahan.harga as perubahan_harga'   ,
                'hewan.quantity'                       ,
                'hewan.path'                           ,
                'hewan.created_at'                     ,
                'hewan.updated_at'                     ,
            );
    }
}
