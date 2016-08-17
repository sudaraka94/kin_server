<?php
//here goes the db access layer
function connect_db(){
	$server='db4free.net ';
	$user='kinteam';
	$password='kinserver';
	$database='kindb';
	$connection=mysqli_connect($server,$user,$password,$database);
	return 	$connection;
}

//this function creates a new entry in user db
function new_member($conn,$user,$pass){

	var $query="INSERT INTO user VALUES ('".$user."','".$pass."')";

	if(Mysqli_query($conn,$query)){
		return 'hi';
	}
	else{
		return false;
	}
}
?> 