<?php

namespace App\Libraries;
use App\Models\UserModel;

class Auth
{
	protected $db;
	protected $user;
	protected $session;
	public function __construct(){
		$db = \Config\Database::connect();
		 $this->user = $db->table('users');
		 $this->session = \Config\Services::session();
	}

	public function passwordhash($password)
	{
		$options = array(
		'cost' => 4,
		);
		return password_hash($password, PASSWORD_BCRYPT, $options);
	}

	public function register($firstname,$lastname,$address,$email,$phone_number, $password){
		$data = [
			'first_name' => $firstname,
			'last_name' => $lastname,
            'address' => $address,
            'email' => $email,
            'phone_number' => $phone_number,
			'password' => $this->passwordhash($password),
		];

		$result = $this->user->insert($data);
		if($result)
        return true;


	}

	public function login($email, $password) {
		$row = $this->user->where('email', $email)->get()->getResult();

		if($row)
		{
			if(password_verify($password, $row[0]->password))
			{
				return  $row[0]->user_id;
			} else {
				return  false;
			}
		}
	}

	/**
	 * Set up session for login
	 * @param $this
	 */
	public function set_logged_in($username) {
		return $this->session->set(array('username' => $username, 'loggedin' => 1));
	}

	/**
	 * Check if user is Logged in
	 * @return bool TRUE is logged in
	 */
	public function is_logged_in()
	{
		if($this->session->get('loggedin') === 1)
			return true;
	}

	/**
	 * Get User ID
	 * @return string User ID from Session
	 */
	public function get_username()
	{
		$username = $this->session->get('username');
		return !empty($username) ? $username : false;
	}

	/**
	 * Check if user's usertype
	 * @return int
	 */
	public function get_usertype()
	{
		$username = $this->session->get('username');
		$row = $this->user->where('id', $username)
    					->get()->getResult();

    	return $row[0]->position;
	}

	

	public function set_logged_out() {
		$this->session->remove(array('loggedin', 'username'));
		$this->session->destroy();
	}
}