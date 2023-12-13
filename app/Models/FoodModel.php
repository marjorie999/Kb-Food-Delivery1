<?php

namespace App\Models;

use CodeIgniter\Model;

class FoodModel extends Model
{
    protected $table            = 'food_table';
    protected $allowedFields    = ['category_id', 'food_category', 'food_name', 'food_price', 'food_description', 'food_image'];

    public function __construct() {
        parent::__construct();
        $db = \Config\Database::connect();
        $builder = $db->table('food_table');
    }

}
