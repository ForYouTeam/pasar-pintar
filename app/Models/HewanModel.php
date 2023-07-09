<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
    ];
}
