<?php
//this is the controller for manipulating the shopping list
function add_item($user,$Jitems){
	include_once '../lib/model/db.php';
	$connection=connect_db();
	$Jlist=get_item($user);

	$list=json_decode($Jlist);
	$items=json_decode($Jitems);
	
	if($Jlist=='"db error"'){
		return json_encode('db error');
	}
	if(is_null($list)!=1){

		foreach($items as $item){

			array_push($list, $item);
		}
		$Jlist=json_encode($list);
		$status=new_item($connection,$user,$Jlist);
	}else{
		$status=new_entry($connection,$user,$Jitems);
					
	}

	if ($status){
		return json_encode('success');
	}
	else{
		return json_encode('db error');
	}
} 

function get_item($user){
	include_once '../lib/model/db.php';
	$connection=connect_db();
	$result=item_list($connection,$user);
	$list=$result->fetch_array(MYSQLI_ASSOC);
	if(is_null($list)==1){
		return null;
	}
	if ($list){
		return $list['lists'];

	}
	else{
		return json_encode('db error');
	}

}