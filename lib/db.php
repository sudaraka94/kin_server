<?php
//here goes the db access layer
function connect_db(){
	$server='localhost';
	$user='root';
	$password='19940829';
	$database='kin';
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