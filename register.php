<?php
require_once('config.php');
require_once('database.php');

$db = Database::getInstance();
$conn = $db->getConnection();

$nome = $_POST['nome'];
$email = $_POST['email'];
$senha = $_POST['senha'];

session_start();

if (empty($nome) || empty($senha) || empty($email)) {
    $response = array('success' => false, 'message' => "Por favor, preencha todos os campos.");
    $_SESSION['auth_response'] = $response;
    header('Location: login.php');
    exit();
}

if (!ctype_alnum($nome) || !ctype_alnum($senha)) {
    $response = array('success' => false, 'message' => "Nome e senha devem conter apenas letras e números.");
    $_SESSION['auth_response'] = $response;
    header('Location: login.php');
    exit();
}

// Verificar se o e-mail já está cadastrado
$query = "SELECT * FROM tb_user WHERE user_email = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $response = array('success' => false, 'message' => "E-mail já cadastrado.");
    $_SESSION['auth_response'] = $response;
    header('Location: login.php');
    exit();
}

// Inserir novo usuário
$insert = "INSERT INTO `tb_user` (`user_ID`, `user_name`, `user_password`, `user_email`) VALUES (NULL, ?, ?, ?)";
$stmt = $conn->prepare($insert);
$stmt->bind_param("sss", $nome, $senha, $email);
$result = $stmt->execute();

$response = array('success' => true, 'register' => "Cadastro Realizado com Sucesso!");
$_SESSION['auth_response'] = $response;

$stmt->close();
$conn->close();
header('Location: login.php');
exit();
?>
