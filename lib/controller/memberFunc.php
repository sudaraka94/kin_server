<?php


//this is the controller for member functions
function sign_up($user,$pass){
	include_once '../lib/model/db.php';
	$connection=connect_db();
	$status=new_member($connection,$user,$pass);

	if ($status){
		return json_encode('success');
	}
	elseif ($status==0) {
		return json_encode('duplicate username');
	}
	else{
		return json_encode('db error');
	}
} 

function login($user,$pass){
	include_once '../lib/model/db.php';

	$connection=connect_db();
	$password=member_login($connection,$user);

	if ($password){
		$data=$password->fetch_array(MYSQLI_ASSOC);
		if($data['password']==$pass){
			return json_encode("true");
		}
		else{
			return json_encode('invalid credentials');
		}
	}
	else{
		return json_encode('db error');
	}
}
?>