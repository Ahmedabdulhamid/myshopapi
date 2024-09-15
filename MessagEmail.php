<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset-UTF-8");
header("Acsses-Control-Allow-Method: *");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: *");
error_reporting(0);

include_once("./connect.php");
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;
require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';
$mail = new PHPMailer(true);
$data=json_decode(file_get_contents("php://input"));

$connect=new ConnectModel();
$query="SELECT * FROM contact WHERE email=?";

$params=[$data->email];
$output=$connect->get_message($query,$params);
echo json_encode($output,JSON_PRETTY_PRINT);
$mail->isSMTP();                                            //Send using SMTP
$mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
$mail->SMTPAuth   = true;                                   //Enable SMTP authentication
$mail->Username   = 'ahmedabdulhamidff21@gmail.com';                     //SMTP username
$mail->Password   = 'xetromkhylgkplvs';                               //SMTP password
$mail->SMTPSecure = 'ssl';
$mail->Port       = 465; 
$mail->setFrom($data->email, 'myshop');
$mail->addAddress("ahmedabdulhamidff21@gmail.com"); 
$mail->isHTML(true);                                  
$mail->Subject = ' Subject ' .$data->subject;
$mail->Body    = ucwords($data->message);     
$mail->send();