<?php

namespace App\Models;

use CodeIgniter\Model;

class Transaksi1Model extends Model
{
    protected $table = 'transaksi1';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'username', 'total_harga', 'alamat', 'ongkir', 'status'
    ];
}
