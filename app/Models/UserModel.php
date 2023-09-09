<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'tb_user';
    protected $primaryKey = 'id_user';
    protected $allowedFields = ['email', 'nama', 'password', 'role'];

    public function getUserByEmail($email)
    {
        return $this->where('email', $email)->first();
    }
}
