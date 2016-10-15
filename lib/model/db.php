<?php
//here goes the db access layer
function connect_db(){
	$server='sql6.freemysqlhosting.net';
	$user='sql6140317';
	$password='r8ftrsjEtW';
	$database='sql6140317';
	$connection=new mysqli($server,$user,$password,$database);
	return 	$connection;

}

//this function creates a new entry in user db
function new_member($conn,$user,$pass){
	$query="INSERT INTO user (user_name,password) VALUES ('".$user."','".$pass."')";
	$result=Mysqli_query($conn,$query);

	if(($conn->errno)=='1062'){
		return 0;
	}
	else if($result){
		return true;
	}
	else{
		return false;
	}
}

function member_login($conn,$user){
	$query="SELECT password FROM user WHERE user_name='".$user."'";
	$result=Mysqli_query($conn,$query);

	if(!$result){
		return false;
	}
	else{
		return $result;
	}
}

function new_item($conn,$user,$items){
	$query="UPDATE items SET lists='".$items."' WHERE user_name='".$user."'";
	$result=Mysqli_query($conn,$query);
	if($result){
		return true;
	}
	else{
		return false;
	}
}

function new_entry($user_id,$list_id,$item_name,$quantity){
	$conn=connect_db();
	$query="INSERT INTO items (user_id,list_id,item_name,quantity) VALUES ('".$user_id."','".$list_id."','".$item_name."','".$quantity."')";
	echo $query;
	$result=Mysqli_query($conn,$query);
	if($result){
		$r_id=mysqli_insert_id($conn);
		return json_encode($r_id);
	}
	else{
		return false;
	}
}

function item_list($conn,$list_id){
	$query="SELECT * FROM items WHERE list_id='".$list_id."' AND item_deleted='0'";
	$result=Mysqli_query($conn,$query);
	if(!$result){
		return false;
	}
	else{
		return $result;
	}
}

function delete_item($item_id){
	$connection=connect_db();
	$query="UPDATE items SET item_deleted='1' WHERE item_id='".$item_id."'";
	// return $query;
	$result=Mysqli_query($connection,$query);
	if(!$result){
		return false;
	}
	else{
		return 'success';
	}


}

//getting all the lists belong to one user
function get_user_list($user_id){
	$connection=connect_db();
	$query="SELECT item_name FROM lists JOIN items on items.list_id=lists.list_id join user_relation on lists.familly_id=user_relation.family_id where user_relation.user_id=".$user_id;
	$result=Mysqli_query($connection,$query);
	if(!$result){
		return false;
	}
	else{
		return $result;
	}
}

//this returns the offers list
function get_offers(){
	$connection=connect_db();
	$query='SELECT * FROM free_offer';
	$result=Mysqli_query($connection,$query);
	if(!$result){
		return false;
	}
	else{
		return $result;
	}
}

function get_discounts(){
	$connection=connect_db();
	$query='SELECT * FROM discount';
	$result=Mysqli_query($connection,$query);
	if(!$result){
		return false;
	}
	else{
		return $result;
	}
}

function get_tp($user_id){
	$connection=connect_db();
	$query='SELECT tp_num FROM user WHERE user_id='.$user_id;
	$result=Mysqli_query($connection,$query);
	if(!$result){
		return false;
	}
	else{
		return $result;
	}
}
?> 