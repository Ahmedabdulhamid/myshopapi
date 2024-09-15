<?Php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset-UTF-8");
header("Acsses-Control-Allow-Method: *");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: *");
session_start();
error_reporting(0);
$arr=array();
include_once("connectSqol.php");
$data = json_decode(file_get_contents("php://input"));
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;
require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';
$select = "select * from users where `email`='$data->email' ";
$result = mysqli_query($conn, $select);
$row = mysqli_fetch_assoc($result);
$mail = new PHPMailer(true);
$token=mt_rand(99999,999999);
if ($data->email===$row['email']) {
   // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                 
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'ahmedabdulhamidff21@gmail.com';                     //SMTP username
    $mail->Password   = 'xetromkhylgkplvs';                               //SMTP password
    $mail->SMTPSecure = 'ssl';
    $mail->Port       = 465; 
    $mail->setFrom('myshop@gamil.com', 'myshop');
    $mail->addAddress($data->email); 
    $mail->isHTML(true);                                  
    $mail->Subject = ' your verficationt code is ' .$token;
    $mail->Body    = ucwords("hello our customer you can update your password and your code verfication code"." ".$token);     
    $mail->send();

    $arr=[
        "message"=>'Message has been sent',
        'code'=>$token
    ];
    echo json_encode($arr,JSON_PRETTY_PRINT);


}

else{
    $arr=[
        "message"=>'your email is not valide',
    ];
    echo json_encode($arr,JSON_PRETTY_PRINT);

   
}


?>
