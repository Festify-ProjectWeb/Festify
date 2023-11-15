<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Receber dados do formulário
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $motivo = $_POST['motivo'];
    $mensagem = $_POST['mensagem'];

    // Envio de email
    $destinatario = "seu_email@example.com";
    $assunto = "Contato do Formulário Fale Conosco";
    $corpo_email = "Nome: $nome\n";
    $corpo_email .= "E-mail: $email\n";
    $corpo_email .= "Motivo de Contato: $motivo\n";
    $corpo_email .= "Mensagem: $mensagem\n";

    mail($destinatario, $assunto, $corpo_email);

    //Devemos criar uma pagina de confirmação
    header("Location: obrigado.php");
    exit();
}
?>