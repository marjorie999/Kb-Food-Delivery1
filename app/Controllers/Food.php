<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\FoodModel;

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, OPTIONS");

class Food extends BaseController
{
    public function index()
    {
        $model = new FoodModel();
        $data['food_list'] = $model->orderBy('food_id', 'ASC')->findAll();
        
        if(!$data['food_list']){
            return json_encode(['msg' => 'No entry.']);
        }

        return json_encode(['data' => $data['food_list']]);
    }

    public function test() {
        return 'etrertrt';
    }

    public function details(...$ids) {
        $model = new FoodModel();
        $data['food_details'] = $model->whereIn('food_id', $ids)->get()->getResult();
    
        if (empty($data['food_details'])) {
            return json_encode(['msg' => 'Not found.']);
        }
    
        return json_encode(['data' => $data['food_details']]);
    }

    public function create() {
        $model = new FoodModel();

         // Retrieve the form data from POST request
         $data = array(
            'category_id' => $this->request->getVar('category_id'),
            'food_name' => $this->request->getVar('food_name'),
            'food_price' => $this->request->getVar('food_price'),
            'food_description' => $this->request->getVar('food_description'),
            'food_image' => $this->request->getVar('food_image')
            // Add more fields as needed
        );

        // Pass data to the model to save into the database
        $saved = $model->insert($data);

        if ($saved) {
            // Optionally, send a success response
            $response = array('status' => 'success', 'message' => 'Food saved successfully');
            echo json_encode($response);
        } else {
            // If save operation fails
            $response = array('status' => 'error', 'message' => 'Failed to save food');
            echo json_encode($response);
        }
        
    }

    public function update() {
        $model = new FoodModel();
        // Retrieve the form data from POST request
        $food_id = $this->request->getVar('food_id');

        $data = array(
            'category_id' => $this->request->getVar('category_id'),
            'food_name' => $this->request->getVar('food_name'),
            'food_price' => $this->request->getVar('food_price'),
            'food_description' => $this->request->getVar('food_description'),
            'food_image' => $this->request->getVar('food_image')
            // Add more fields as needed
        );

        // Pass data to the model to update in the database
        $updated = $model->where('food_id', $food_id)->set($data)->update();

        if ($updated) {
            // Optionally, send a success response
            $response = array('status' => 'success', 'message' => 'Food updated successfully');
            echo json_encode($response);
        } else {
            // If update operation fails
            $response = array('status' => 'error', 'message' => 'Failed to update food');
            echo json_encode($response);
        }

       
    }

    public function getMenuDetails($id) {
        $model = new FoodModel();

        $food = $model->where('food_id',$id)->first();

        if($food){
            return json_encode(['data' => $food, 'msg' => 'Success']);
        }

        return json_encode(['msg' => 'error.']); 
    }

    
}
