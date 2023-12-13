<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\FoodModel;
use App\Models\OrderedFoodModel;
use App\Models\OrderModel;
use App\Models\UserModel;

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, OPTIONS");

class Admin extends BaseController
{
    public function index()
    {
        $model = new UserModel();
        $data['user_list'] = $model->orderBy('user_id', 'ASC')->findAll();
        
        if(!$data['user_list']){
            return json_encode(['msg' => 'No entry.']);
        }

        return json_encode(['data' => $data['user_list']]);
    }
  

    public function fetchOrderData() {

        // Fetch data from 'order_table'
        $model = new OrderModel();
        $data['order_list'] = $model->orderBy('order_id', 'ASC')->findAll();
        
        if(!$data['order_list']){
            return json_encode(['msg' => 'No entry.']);
        }

        return json_encode(['data' => $data['order_list']]);
    }

    public function fetchOrderedFoodData() {
        $model = new OrderedFoodModel();
        $data['ordered_list'] = $model->orderBy('ordered_id', 'ASC')->findAll();
        
        if(!$data['ordered_list']){
            return json_encode(['msg' => 'No entry.']);
        }

        return json_encode(['data' => $data['ordered_list']]);
    }

    public function getJoinedOrderData() {
        $orderModel = new OrderModel();
        $orderedFoodModel = new OrderedFoodModel();
        $userModel = new UserModel();

        // Perform multiple joins between 'order_table', 'ordered_food_table', and 'users'
        $data = $orderModel->select('order_table.*, ordered_food_table.food_id, users.first_name, users.last_name')
            ->join('ordered_food_table', 'ordered_food_table.order_id = order_table.order_id')
            ->join('users', 'users.user_id = order_table.customer_id')
            ->findAll();

        if (empty($data)) {
            return $this->response->setJSON(['msg' => 'No joined data found.']);
        }

        return $this->response->setJSON(['data' => $data]);

        // $orderModel = new OrderModel();
        // $orderedFoodModel = new OrderedFoodModel();

        // // Perform a join between 'order_table' and 'ordered_food_table'
        // $data = $orderModel->select('order_table.*, ordered_food_table.food_id')
        //     ->join('ordered_food_table', 'ordered_food_table.order_id = order_table.order_id')
        //     ->findAll();

        // if (empty($data)) {
        //     return $this->response->setJSON(['msg' => 'No joined data found.']);
        // }

        // return $this->response->setJSON(['data' => $data]);
    }

    public function details($id) {
        $model = new UserModel();
        $data['user_details'] = $model->where('user_id', $id)->first();
        if(!$data['user_details']){
            return json_encode(['msg' => 'Not found.']);
        }

        return json_encode(['data' => $data['user_details']]);

    }
}
