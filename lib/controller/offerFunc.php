<?php
//this function tests whether there is a similer iterm that has a offer in our list
function match_offer_user($user_id){
	include_once '../lib/model/db.php';
    include_once '../lib/ideaMart/Notifier.php';
	$user_result=get_user_list($user_id);
	$offer_array=array();
	while($row =mysqli_fetch_assoc($user_result))
    {
    	$item_name=$row['item_name'];
        $offer_result=get_offers();
        while($offer_row=mysqli_fetch_assoc($offer_result)){
        	similar_text($item_name,$offer_row['item_name'],$presentage);
        	if($presentage>70){
                free_offer_notify($offer_row['notify_message'],get_tp($user_id));
        		$offer_array[]=$offer_row['item_name'];
        	}
        }
    }
    return $offer_array;
    
}

function match_discount_user($user_id){
    include_once '../lib/model/db.php';
    include_once '../lib/ideaMart/Notifier.php';
    $connection=connect_db();
    $user_result=get_user_list($user_id);
    $offer_array=array();
    while($row =mysqli_fetch_assoc($user_result))
    {
        $item_name=$row['item_name'];
        $offer_result=get_discounts();
        while($offer_row=mysqli_fetch_assoc($offer_result)){
            similar_text($item_name,$offer_row['offer_item_name'],$presentage);
            if($presentage>70){
                free_offer_notify($offer_row['message'],get_tp($user_id));
            }
        }
    }
    return $offer_array;
    
}	

function match_offer_push($user_id){
    include_once '../lib/model/db.php';
    $user_result=get_user_list($user_id);
    $offer_array=array();
    while($row =mysqli_fetch_assoc($user_result))
    {
        $item_name=$row['item_name'];
        $offer_result=get_offers();
        while($offer_row=mysqli_fetch_assoc($offer_result)){
            similar_text($item_name,$offer_row['item_name'],$presentage);
            if($presentage>0){
                $offer_array[]=$offer_row['notify_message'];
//array('description'->$offer_row['notify_message']);
            }
        }
    }

    return json_encode($offer_array);
    
}

function match_discount_push($user_id){
    include_once '../lib/model/db.php';
    $user_result=get_user_list($user_id);
    $offer_array=array();
    while($row =mysqli_fetch_assoc($user_result))
    {
        $item_name=$row['item_name'];
        $offer_result=get_discounts();
        while($offer_row=mysqli_fetch_assoc($offer_result)){
            similar_text($item_name,$offer_row['item_name'],$presentage);
            if($presentage>70){
                $offer_array[]=('description'->$offer_row['message']);
            }
        }
    }
    return json_encode($offer_array);
    
}
