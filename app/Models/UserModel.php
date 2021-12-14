<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = "users";
    protected $primaryKey = 'id';
    protected $returnType = 'object';
    protected $allowedFields = ["id", "first_name", "last_name","email","password"];

    public function loginUser($email)
    {
        return $this->table('users')
                    ->where('users.email', $email)
                    ->get()
                    ->getRowArray();
    }
}
