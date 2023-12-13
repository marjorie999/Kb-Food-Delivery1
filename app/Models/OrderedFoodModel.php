<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderedFoodModel extends Model
{
    protected $table            = 'ordered_food_table';
    protected $allowedFields    = ['food_id', 'order_id'];

    public function __construct() {
        parent::__construct();
        $db = \Config\Database::connect();
        $builder = $db->table('ordered_food_table');
    }
}
