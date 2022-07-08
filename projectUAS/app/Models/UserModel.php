<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $allowedFields = [
        'fullname',
        'email',
        'username',
        'password',
        'role',
        'alamat',
        'telepon',
    ];
}
