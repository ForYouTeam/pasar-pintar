<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UpdateHargaModel extends Model
{
    use HasFactory;
    protected $table = 'update_harga';
    protected $fillable = [
        'code',
        'harga',
        'profile_id',
        'created_at',
        'updated_at'
    ];
}
