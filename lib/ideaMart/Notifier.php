<?php
/**
 *   (C) Copyright 1997-2013 hSenid International (pvt) Limited.
 *   All Rights Reserved.
 *
 *   These materials are unpublished, proprietary, confidential source code of
 *   hSenid International (pvt) Limited and constitute a TRADE SECRET of hSenid
 *   International (pvt) Limited.
 *
 *   hSenid International (pvt) Limited retains all title to and intellectual
 *   property rights in these materials.
 */

include_once 'SmsReceiver.php';
include_once 'SmsSender.php';
include_once 'log.php';
ini_set('error_log', 'sms-app-error.log');

// try {
//     // echo 'hi';
//     $receiver = new SmsReceiver(); // Create the Receiver object

//     $content = $receiver->getMessage(); // get the message content
//     $address = $receiver->getAddress(); // get the sender's address
//     $requestId = $receiver->getRequestID(); // get the request ID
//     $applicationId = $receiver->getApplicationId(); // get application ID
//     $encoding = $receiver->getEncoding(); // get the encoding value
//     $version = $receiver->getVersion(); // get the version

//     logFile("[ content=$content, address=$address, requestId=$requestId, applicationId=$applicationId, encoding=$encoding, version=$version ]");

//     $responseMsg;

//     //your logic goes here......
//     $split = explode(' ', $content);
//     $responseMsg = bmiLogicHere($split);

//     // Create the sender object server url
//     $sender = new SmsSender("http://localhost:7000/sms/send");

//     //sending a one message

//  	$applicationId = "APP_000001";
//  	$encoding = "0";
//  	$version =  "1.0";
//     $password = "password";
//     $sourceAddress = "77000";
//     $deliveryStatusRequest = "1";
//     $charging_amount = ":15.75";
//     $destinationAddresses = array("tel:94771122336");
//     $binary_header = "";
//     $res = $sender->sms($responseMsg, $destinationAddresses, $password, $applicationId, $sourceAddress, $deliveryStatusRequest, $charging_amount, $encoding, $version, $binary_header);

// } catch (SmsException $ex) {
//     //throws when failed sending or receiving the sms
//     error_log("ERROR: {$ex->getStatusCode()} | {$ex->getStatusMessage()}");
// }

/*
    BMI logic function
**/
function free_offer_notify($message,$tp_number)
{
    try{
        $responseMsg =$message ;

        // Create the sender object server url
        $sender = new SmsSender("http://localhost:7000/sms/send");

        //sending a one message

        $applicationId = "APP_000001";
        $encoding = "0";
        $version =  "1.0";
        $password = "password";
        $sourceAddress = "77000";
        $deliveryStatusRequest = "1";
        $charging_amount = ":15.75";
        $destinationAddresses = array('tel:'.$tp_number);
        $binary_header = "";
        $res = $sender->sms($responseMsg, $destinationAddresses, $password, $applicationId, $sourceAddress, $deliveryStatusRequest, $charging_amount, $encoding, $version, $binary_header);

        } catch (SmsException $ex) {
    //throws when failed sending or receiving the sms
    error_log("ERROR: {$ex->getStatusCode()} | {$ex->getStatusMessage()}");
}


}

/*
    Get BMI value
**/

function getBMIValue($weight, $height)
{
    return ($weight / pow($height, 2));
}

/*
    Get category according to BMI value
**/

function getCategory($bmiValue)
{
    if ($bmiValue < 18.5) {
        return "Underweight";
    } else if ($bmiValue >= 18.5 && $bmiValue < 24.9) {
        return "Normal Weight";
    } else if ($bmiValue >= 25 && $bmiValue < 29.9) {
        return "Overweight";
    } else {
        return "Obesity";
    }
}

?>