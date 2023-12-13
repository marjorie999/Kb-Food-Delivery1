<?php

namespace App\Models;

use CodeIgniter\Model;

class CategoryModel extends Model
{
    protected $table            = 'category_table';
    protected $allowedFields    = ['category_name'];

    public function __construct() {
        parent::__construct();
        $db = \Config\Database::connect();
        $builder = $db->table('category_table');
    }
    
}
