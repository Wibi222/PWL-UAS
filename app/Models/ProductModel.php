<?php 
namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{
    protected $table = 'product'; // Adjust this to your table name
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'nama', 'harga', 'jumlah', 'foto', 'created_at', 'updated_at'
    ];

    // Validation rules for model
    protected $validationRules = [
        'nama' => 'required|min_length[5]',
        'harga' => 'required|numeric',
        'jumlah' => 'required|numeric',
    ];

    // Custom validation messages
    protected $validationMessages = [
        'nama' => [
            'required' => 'Nama harus diisi',
            'min_length' => 'Nama minimal terdiri dari 5 karakter'
        ],
        'harga' => [
            'required' => 'Harga harus diisi',
            'numeric' => 'Harga harus berupa angka'
        ],
        'jumlah' => [
            'required' => 'Jumlah harus diisi',
            'numeric' => 'Jumlah harus berupa angka'
        ],
    ];
}
