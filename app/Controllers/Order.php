<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\OrderModel;
use App\Models\OrderedFoodModel;
use App\Models\FoodModel;
header('Access-Control-Allow-Origin: *');


class Order extends BaseController
{
    public function index()
    {
        return '';
    }

    public function create() // place order
    {
        // Set CORS headers
        header("Access-Control-Allow-Origin: *");
        
        
        $model = new OrderModel();

        // Get data from your form or request
        $data = [
            'customer_id' => $this->request->getVar('customer_id'),
            'address' => $this->request->getVar('address'),
            'total_price' => $this->request->getVar('total_price'),
        ];

        
        // // Insert data into the database
        $inserted = $model->insert($data);


        if ($inserted) {
            $food_ids = $this->request->getVar('food_id');
            $idArray = json_decode($food_ids);
            $orderModel = new OrderedFoodModel();

            
            foreach($idArray as $val){
                $foods = [
                    'food_id' => $val,
                    'order_id' => $inserted
                ];
                $res = $orderModel->insert($foods);
                if (!$res) {
                    return json_encode(['msg' => 'Failed to create order']);
                }
            }
            

            return json_encode(['msg' => 'Order created successfully', 'order_id' => $inserted]);
        } else {
            return json_encode(['msg' => 'Failed to create order']);
        }
    }

    public function getOrderId($id) {
        $model = new OrderModel();
        $data['food_details'] = $model->select('order_table.order_id, food_table.food_name, food_table.food_price')
                                        ->join('ordered_food_table', 'ordered_food_table.order_id=order_table.order_id')
                                        ->join('food_table', 'food_table.food_id=ordered_food_table.food_id')
                                        ->where('order_table.order_id', $id)
                                        ->findAll();
    
        if (empty($data['food_details'])) {
            return json_encode(['msg' => 'Not found.']);
        }
    
        return json_encode(['data' => $data['food_details']]);
    }

    public function orderDelivered() {
        $model = new OrderModel();

        $exist = $model->where('order_id', $this->request->getVar('order_id'))->first();

        if($exist['status'] != 'to deliver')
        {
            return json_encode(['msg' => "Something went wrong."]);
        }

        $res = $model->set('status', 'delivered')->where('order_id', $this->request->getVar('order_id'))->update();

        if($res){
            return json_encode(['msg' => "Order received."]);
        }

        return json_encode(['msg' => "Something went wrong."]);
    }
}
