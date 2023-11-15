<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fale Conosco</title>
    <link rel="stylesheet" href="styles/faleconosco.css">
</head>
<header class="logo">
    <h1><img src="images/png-FESTIFY.png" width="200"></h1>
</header> 

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

<body>   
    <form action="#" method="post">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required>

        <label for="email">E-mail:</label>
        <input type="email" id="email" name="email" required>

        <label for="motivo">Motivo de Contato:</label>
        <select id="motivo" name="motivo" required>
            <option value="" disabled selected>Selecione...</option>
            <option value="duvida">Dúvida</option>
            <option value="feedback">Feedback</option>
            <option value="problema">Problema</option>
            <option value="outro">Outro</option>
        </select>

        <label for="mensagem">Mensagem:</label>
        <textarea id="mensagem" name="mensagem" rows="4" required></textarea>

        <input type="submit" value="Enviar">
    </form>
</body>
</html>
