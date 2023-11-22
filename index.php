<?php

require_once('config.php');
require_once('database.php');


$db = Database::getInstance();

$conn = $db->getConnection();

$query = "SELECT * FROM tb_eventos";

$result = $conn->query($query);

$titulos = array();
$descs = array();
$imgs = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $titulos[] = $row['evento_nome'];
        $imgs[] = base64_encode($row['evento_img']);
        $descs[] = $row['evento_desc'];
    }
}else {
    $titulos[] = "Nenhum evento encontrado";
    $descs[] = "";
}

$conn -> close();


?>
<!DOCTYPE html>
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
                    <a href="eventos.php">Meus Eventos</a>
                    <a href="login.php" class="right">Cadastre-se</a>
                    <a href="login.php" class="right">Login</a>
                </div>
            </div>
            
        </header>
        <div class="separador"></div>
        <div class="container">
            <?php for($i = 0; $i < count($titulos); $i++) : ?>
                <div class="card" style="--cor:#009688;">
                    <div class="cardImg">
                        <img src="data:image/jpeg;base64,<?php echo $imgs[$i]; ?>" alt="Banner 1">
                    </div>
                    <div class="conteudo">
                        <h2><?php echo $titulos[$i]; ?></h2>
                        <p><?php echo $descs[$i];?></p>
                    </div>
                </div>
            <?php endfor; ?>

        </div>
        <div class="separador"></div>
        <footer class="footer">
            <a href="quemsomos.html">Quem somos</a> |
            <a href="faleconosco.html">Fale conosco</a> |
            <p>Copyright &copy; 2023</p>
        </footer>
    </body>
</html>