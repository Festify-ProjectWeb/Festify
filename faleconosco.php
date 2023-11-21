<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/faleconosco.css">
    <title>Fale Conosco</title>
</head>

<header class="logo_faleconosco">
    <h1><img src="images/png-FESTIFY.png" width="300"></h1>
</header>

<body>    

    <div class="header">
        <a href="/_Festify/index.html">Home</a>
        <a href="#eventos">Eventos</a>
        <a href="#localização">Localização</a>
    </div>

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
