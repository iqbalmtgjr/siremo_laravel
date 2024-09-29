<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hargasewa extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $table = 'harga_sewa';

    public function kendaraan()
    {
        return $this->belongsTo(Kendaraan::class);
    }
}
