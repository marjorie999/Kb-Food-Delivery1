<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table            = 'users';
    
    protected $allowedFields = ['first_name', 'last_name', 'address', 'email', 'phone_number', 'role', 'password'];

    public function __construct() {
        parent::__construct();
        $db = \Config\Database::connect();
        $builder = $db->table('users');
    }
}
