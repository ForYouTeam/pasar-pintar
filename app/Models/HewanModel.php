<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HewanModel extends Model
{
    use HasFactory;
    protected $table = 'hewan';
    protected $fillable = [
        'nama',
        'jenis_id',
        'berat',
        'jk',
        'usia',
        'status',
        'harga',
        'harga_id',
        'profile_id',
        'quantity',
        'path',
        'keterangan',
        'created_at',
        'updated_at'
    ];

    public function scopejoinList($query)
    {
        return $query
            ->leftJoin('jenis as a'       , 'hewan.jenis_id'  , 'a.id')
            ->leftJoin('update_harga as b', 'hewan.harga_id'  , 'b.id')
            ->leftJoin('profile as c'     , 'hewan.profile_id', 'c.id')
            ->select(
                'hewan.id',
                'hewan.nama',
                'a.nama_jenis as nama_jenis',
                'hewan.berat',
                'hewan.jk',
                'hewan.usia',
                'hewan.status',
                'hewan.harga',
                'b.code as code_hewan',
                'b.harga as perubahan_harga',
                'c.nama_pemilik as pemilik',
                'c.nama_usaha as peternakan',
                'c.telepon as telepon',
                'c.alamat as alamat',
                'hewan.quantity',
                'hewan.path',
                'hewan.keterangan',
                'hewan.created_at',
                'hewan.updated_at',
            );
    }

    public function joinJenis() 
    {
        return $this->belongsTo(JenisModel::class, 'jenis_id');
    }
}
