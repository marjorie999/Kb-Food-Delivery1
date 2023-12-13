<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CategoryModel;

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, OPTIONS");

class Category extends BaseController
{
    public function index()
    {
        $model = new CategoryModel();
        $data['category_list'] = $model->orderBy('category_id', 'ASC')->findAll();
        
        if(!$data['category_list']){
            return json_encode(['msg' => 'No entry.']);
        }

        return json_encode(['data' => $data['category_list']]);
    }
}
