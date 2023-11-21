<?php


session_start();

require_once('config.php');
require_once('database.php');

if (isset($_SESSION['auth_response']) && $_SESSION['auth_response']['sucess'] === true) {
    $user = $_SESSION['auth_response'];

    $db = Database::getInstance();

    $conn = $db->getConnection();

    $query = "SELECT evento_nome FROM tb_eventos";

    $result = $conn->query($query);

    $titulos = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $titulos[] = $row['evento_nome'];
        }
    }else {
        $titulo = "Nenhum evento encontrado";
    }

    $conn -> close();
} else {
    header("Location: login.php");
}

?>

<html>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap">
        <link rel="stylesheet" href="styles/home.css">
        <title>FESTIFY</title>
    </head>

    <body>
        <header>
            
            <div class="header_container">
                <div class="logo">
                    <img src="images/png-FESTIFY.png" width="200">
                </div>
                <div class="barra_pesquisa">
                    <input type="text" placeholder="Pesquisar">
                </div>
                <div class="bt_pesquisa">
                    <button type="submit">Pesquisar</button>
                </div>
            </div>
            
            <div class="menu_container">
                <div class="header_menu">
                    <a href="index.php">Home</a>
                    <a href="#eventos">Eventos</a>
                    <a href="#localização">Localização</a>
                    <a href="login.php" class="right">Cadastre-se</a>
                    <a href="login.php" class="right">Login</a>
                </div>
            </div>
            
        </header>
        <div class="separador"></div>
        <div class="container">
            <?php foreach ($titulos as $titulo) : ?>
                <div class="card" style="--cor:#009688;">
                    <div class="cardImg">
                        <img src="images/background_test.jpg" alt="Banner 1">
                    </div>
                    <div class="conteudo">
                        <h2><?php echo $titulo; ?></h2>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                            Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
                            when an unknown printer took a galley</p>
                        <a href="#">CONFIRA</a>
                    </div>
                </div>
            <?php endforeach; ?>

        </div>
        <div class="separador"></div>
        <footer class="footer">
            <a href="#quemsomos">Quem somos</a> |
            <a href="faleconosco.html">Fale conosco</a> |
            <a href="#feedback">Feedback do usuário</a>
            <p>Copyright &copy; 2023</p>
        </footer>
    </body>
</html>