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
$password = $_POST['password'];

$validate = $validateCustomer->validateUser($mail, $password);
if($validate !== ''){
    echo json_encode(['message' => $validate, 'status' => $status]);
    die();
}

for($i = 0; $i < 5; $i++)
    $salt = $salt . rand(0,9);
$password = md5($password . $salt);

try{
    mysqli_query($connect, "update `users` set `password` = '$password', `salt` = '$salt' WHERE `mail` = '$mail'");
    $message = 'пароль успешно изменен';
    $status = 'ok';

} catch(Exception $e) {
    $message = $e->getMessage();
}

echo json_encode(['message' => $message, 'status' => $status]);
