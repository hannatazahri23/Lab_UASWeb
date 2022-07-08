<?php

namespace App\Models;

use CodeIgniter\Model;

class AntrianModel extends Model
{
    protected $table      = 'antrian';
    protected $allowedFields = ['no_antrian', 'id_loket', 'id_users', 'tanggal'];
}
