<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS, post, get');
header("Access-Control-Max-Age", "3600");
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
header("Access-Control-Allow-Credentials", "true");

require_once './connect.php';
require('./UserZi.php');

$validateCustomer = new UserZi();

$salt = '';
$dbPassword = '';
$message = '';
$status = 'error';

$mail = $_POST['mail'];

if(isset($email))
    $message = 'данные не заполнены';

if (!(preg_match("/[0-9a-z]+@[a-z]/", $mail))) {
    $message = 'некорректно введена почта';
}
if($message !== ''){
    echo json_encode(['message' => $message, 'status' => $status]);
    die();
}

try{
    $check_user = mysqli_query($connect, "SELECT * FROM `users` WHERE `mail` = '$mail'");

    if (mysqli_num_rows($check_user) > 0){
        $message = 'почта верная';
        $status = 'ok';
    }
    else
        $message = 'не верная почта';

} catch(Exception $e) {
    $message = $e->getMessage();
}

echo json_encode(['message' => $message, 'status' => $status]);
