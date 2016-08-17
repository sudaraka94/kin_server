<?php
//here goes the db access layer
function connect_db(){
	$server='db4free.net';
	$user='kinteam';
	$password='kinserver';
	$database='kindb';
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

function new_entry($conn,$user,$items){
	$query="INSERT INTO items (user_name,lists) VALUES ('".$user."','".$items."')";
	$result=Mysqli_query($conn,$query);
	if($result){
		return true;
	}
	else{
		return false;
	}
}

function item_list($conn,$user){
	$query="SELECT lists FROM items WHERE user_name='".$user."'";
	$result=Mysqli_query($conn,$query);
	if(!$result){
		return false;
	}
	else{
		return $result;
	}
}

?> 