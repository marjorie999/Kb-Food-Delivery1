<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Libraries\Auth;
use App\Models\UserModel;
header('Access-Control-Allow-Origin: *');
class Authentication extends BaseController
{
    protected $account;
	protected $auth;
	public function __construct(){
		$this->account = model(UserModel::class);
		$this->auth = new Auth();
		helper(['form', 'url']);
	}

    public function index() {
        echo 'wow';
    }

    public function register() {

		$model = new UserModel();

		$isExists = $model->where('email', $this->request->getVar('email'))->first();

		if($isExists){
			return json_encode(['msg' => 'Email already exist.']);
		}
        
		$data = $this->auth->register(
				$this->request->getVar('first_name'),
                $this->request->getVar('last_name'),
				$this->request->getVar('address'),
				$this->request->getVar('email'),
				$this->request->getVar('phone_number'),
				$this->request->getVar('password')
			);
		if($data){
			return json_encode(['msg' => 'Success']);
		}else{
            return json_encode(['msg' => 'Something went wrong.']);
		}
	}

	public function login() {

		

		$data = $this->auth->login(
			$this->request->getVar('email'),
			$this->request->getVar('password')
		);
		if(!$data){
			return json_encode(['msg' => 'Incorrect combination', 'error'=> 1]);
		}
		$this->auth->set_logged_in($data);
		$model = new UserModel();
		$user_info = $model->where('user_id', $data)
							->select('user_id, first_name, last_name, address, email, phone_number, role')
							->get()
							->getResult();
		return json_encode(['msg' => 'Success', 'error'=> 0, 'user_info' => $user_info]);
	}
}
