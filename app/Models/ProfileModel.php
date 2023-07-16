<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfileModel extends Model
{
    use HasFactory;
    protected $table = 'profile';
    protected $fillable = [
        'nama_pemilik',
        'nama_usaha',
        'alamat',
        'telepon',
        'created_at',
        'updated_at'
    ];
}
