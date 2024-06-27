<?php

require "../../mpgClasses.php";

/**************************** Request Variables *******************************/

$store_id='store5';
$api_token='yesguy';

/************************* Transactional Variables ****************************/

$order_id='ord-'.date("dmy-G:i:s");
$cust_id='nqa cust id';
$amount='1.00';
$crypt_type='2';
$network = "MASTERCARD";
$data_key = "ot-PLa88dGe5uSy8TwbI9BeMqur1";
$threeds_server_trans_id = "de1b97ee-c610-4877-b53f-c1c5ecd99bf0";
$ds_trans_id = "de1b97ee-c610-4877-b53f-c1c5ecd99bf0";
$threeds_version = "2.2";
$cavv = "kAABApFSYyd4l2eQQFJjAAAAAAA=";
$dynamic_descriptor = "nqa-dd";


/*********************** Transactional Associative Array **********************/

$googlePayTokenPreauth = new GooglePayTokenPreauth();
$googlePayTokenPreauth->setOrderId($order_id);
$googlePayTokenPreauth->setCustId($cust_id);
$googlePayTokenPreauth->setAmount($amount);
$googlePayTokenPreauth->setCryptType($crypt_type);
$googlePayTokenPreauth->setNetwork($network);
$googlePayTokenPreauth->setDataKey($data_key);
$googlePayTokenPreauth->setThreeDSServerTransId($threeds_server_trans_id);
$googlePayTokenPreauth->setDSTransId($ds_trans_id);
$googlePayTokenPreauth->setThreeDSVersion($threeds_version);
$googlePayTokenPreauth->setCavv($cavv);

$googlePayTokenPreauth->setDynamicDescriptor($dynamic_descriptor);

/**************************** Transaction Object *****************************/

$mpgTxn = new mpgTransaction($googlePayTokenPreauth);

/****************************** Request Object *******************************/

$mpgRequest = new mpgRequest($mpgTxn);
$mpgRequest->setProcCountryCode("CA"); //"US" for sending transaction to US environment
$mpgRequest->setTestMode(true); //false or comment out this line for production transactions

/***************************** HTTPS Post Object *****************************/

/* Status Check Example
$mpgHttpPost  =new mpgHttpsPostStatus($store_id,$api_token,$status_check,$mpgRequest);
*/

$mpgHttpPost = new mpgHttpsPost($store_id,$api_token,$mpgRequest);

/******************************* Response ************************************/

$mpgResponse=$mpgHttpPost->getMpgResponse();

print("\nCardType = " . $mpgResponse->getCardType());
print("\nTransAmount = " . $mpgResponse->getTransAmount());
print("\nTxnNumber = " . $mpgResponse->getTxnNumber());
print("\nReceiptId = " . $mpgResponse->getReceiptId());
print("\nTransType = " . $mpgResponse->getTransType());
print("\nReferenceNum = " . $mpgResponse->getReferenceNum());
print("\nResponseCode = " . $mpgResponse->getResponseCode());
print("\nISO = " . $mpgResponse->getISO());
print("\nMessage = " . $mpgResponse->getMessage());
print("\nIsVisaDebit = " . $mpgResponse->getIsVisaDebit());
print("\nAuthCode = " . $mpgResponse->getAuthCode());
print("\nComplete = " . $mpgResponse->getComplete());
print("\nTransDate = " . $mpgResponse->getTransDate());
print("\nTransTime = " . $mpgResponse->getTransTime());
print("\nTicket = " . $mpgResponse->getTicket());
print("\nTimedOut = " . $mpgResponse->getTimedOut());
print("\nStatusCode = " . $mpgResponse->getStatusCode());
print("\nStatusMessage = " . $mpgResponse->getStatusMessage());
print("\nHostId = " . $mpgResponse->getHostId());
print("\nIssuerId = " . $mpgResponse->getIssuerId());
print("\nSourcePanLast4 = " . $mpgResponse->getSourcePanLast4());
print("\nDataKey = " . $mpgResponse->getDataKey());
print("\nCavvResultCode = " . $mpgResponse->getCavvResultCode());
print("\nPar = " . $mpgResponse->getPar());
print("\nThreeDSVersion = " . $mpgResponse->getThreeDSVersion());
print("\nGooglepayPaymentMethod = " . $mpgResponse->getGooglepayPaymentMethod());

?>

