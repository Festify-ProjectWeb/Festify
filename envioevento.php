<?php
session_start();

require_once('config.php');
require_once('database.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_SESSION['auth_response']) && $_SESSION['auth_response']['success'] === true) {
        $user = $_SESSION['auth_response']['id'];

        $db = Database::getInstance();
        $conn = $db->getConnection();

        // Outros campos do formulário...
        $nome = $_POST['nome'];
        $descricao = $_POST['descricao'];
        $data = $_POST['data'];
        $hora = $_POST['hora'];
        $preco = $_POST['preco'];
        $categoria = $_POST['categoria'];
        $classificacao = $_POST['classificação'];
        $estabelecimento = $_POST['estabelecimento'];

        // Dados da imagem em base64
        $imagemData = $_POST['imagem'];

        // Decodificar a base64 para obter os bytes da imagem
        $imagemBytes = base64_decode($imagemData);

        $insert = "INSERT INTO `tb_eventos` (`evento_ID`, `evento_img`, `evento_nome`, `evento_desc`, `evento_data`, `evento_hora`, `evento_preco`, `estabelecimento_ID`, `categoria_ID`, `classificacao_ID`, `user_ID`) VALUES (NULL, $imagemBytes, $nome, $descricao, $data, $hora, $categoria, $classificacao, $estabelecimento, $user)";
        
        $result = $conn->query($insert);
        $conn->close();
    } else {
        header("Location: login.php");
    }
}
?>
