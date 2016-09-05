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
		array_push($list, $items);
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

function edit_item($id,$user,$item){
	include_once '../lib/model/db.php';
	$connection=connect_db();
	$Jlist=get_item($user);
	$item=json_decode($item);
	$list=json_decode($Jlist);
	if($Jlist=='"db error"'){
		return json_encode('db error');
	}
	$tempL=array();
	if(is_null($Jlist)!=1){
		foreach ($list as $items) {
			if($id!=$items->{'id'}){
				array_push($tempL,$items);
				var_dump($items);
			}
		}
		array_push($tempL,$item);
		$tempL=json_encode($tempL);
		// var_dump($tempL);
		$status=new_item($connection,$user,$tempL);

	}else{
		return json_encode('error');
					
	}

	if ($status){
		return json_encode('success');
	}
	else{
		return json_encode('db error');
	}
}