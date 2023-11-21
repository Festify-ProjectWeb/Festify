<?php

require_once('config.php');
require_once('database.php');

$db = Database::getInstance();

$conn = $db->getConnection();

$email = $_POST['email'];
$senha = $_POST['senha'];

$query = "SELECT user_ID FROM tb_user tu where tu.user_email = '$email' AND tu.user_password = '$senha'";
$result = $conn->query($query);

if ($result->num_rows > 0) {

    $row = $result->fetch_assoc();  
    $response = array('sucess' => true, 'id' => $row['user_ID'], 'message' => "Autenticação bem-sucedida!" );

} else {
    $response = array('sucess' => false, 'id' => null, 'message'=> "Usuário não encontrado <br>ou senha incorreta." );
}

$conn -> close();

session_start();

$cookieParams = session_get_cookie_params();
session_set_cookie_params(
    $cookieParams["lifetime"],
    $cookieParams["path"],
    $cookieParams["domain"],
    false, 
    true 
);

if ($response['sucess'] === true){
    $_SESSION['auth_response'] = $response;
    header('Location: eventos.php');
    exit();
} else{
    $_SESSION['auth_response'] = $response;
    header('Location: login.php');
    exit();
}



?>