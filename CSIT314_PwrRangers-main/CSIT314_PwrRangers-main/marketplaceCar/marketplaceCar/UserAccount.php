<?php
class UserAccount {
//variables
	public $username;
	public $password;
	public $dob;
	public $contactno;
	public $userprofile;

//constructors
	public function __construct(){
		$get_arguments = func_get_args();
		$no_of_arguments = func_num_args();
		
		if(method_exists($this,$method_name ='__construct'.$no_of_arguments)){
			call_user_func_array(array($this,$method_name), $get_arguments);
		}
	}
	
	public function __construct2($username, $password){
		$this->username = $username;
		$this->password = $password;
	}
	
	public function __construct5($username, $password, $dob, $contactno, $userprofile){
		$this->username = $username;
		$this->password = $password;
		$this->dob = $dob;
		$this->contactno = $contactno;
		$this->userprofile = $userprofile;
	}

// getters
	public function getUsername(){
		return $this->username;
	}
	
	public function getPassword(){
		return $this->password;
	}
	
	public function getDOB(){
		return $this->dob;
	}
	
	public function getContactNo(){
		return $this->contactno;
	}
	
	public function getUserprofile(){
		return $this->userprofile;
	}
}
?>