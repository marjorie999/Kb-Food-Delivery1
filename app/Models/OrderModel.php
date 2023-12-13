<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderModel extends Model
{
    protected $table            = 'order_table';
    
    protected $allowedFields    = [
        'customer_id',
        'address',
        'sub_total',
        'total_price',
        'status',
    ];

    public function __construct() {
        parent::__construct();
        $db = \Config\Database::connect();
        $builder = $db->table('order_table');
    }
}
