<?php

namespace App\Models;

use CodeIgniter\Model;

class LoketModel extends Model
{
    protected $table      = 'loket';
    protected $allowedFields = ['loket', 'id_users', 'status'];
}
