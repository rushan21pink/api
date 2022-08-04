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


try{
    $check_user = mysqli_query($connect, "SELECT * FROM `users` WHERE `mail` = '$mail'");

    if (mysqli_num_rows($check_user) > 0){
        $user = mysqli_fetch_assoc($check_user);

        $salt = $user['salt'];

        if(md5($password . $salt) === $user['password']){
            $status = 'ok';
            $message = 'Успешный вход';
        }
        else
            $message = 'Неверный пароль';

    }
    else
        $message = 'не верная почта';

} catch(Exception $e) {
    $message = $e->getMessage();
}

echo json_encode(['message' => $message, 'status' => $status]);
