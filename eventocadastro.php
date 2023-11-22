<?php


session_start();

require_once('config.php');
require_once('database.php');

if (isset($_SESSION['auth_response']) && $_SESSION['auth_response']['success'] === true) {
    $user = $_SESSION['auth_response']['id'];

    $db = Database::getInstance();

    $conn = $db->getConnection();

    $query_cat = "SELECT * FROM tb_categoria";
    $query_classf = "SELECT * FROM tb_classificacao";
    $query_estab = "SELECT * FROM tb_estabelecimento";

    $result_cat = $conn->query($query_cat);
    $result_classf = $conn->query($query_classf);
    $result_estab = $conn->query($query_estab);

    $categorias = array();
    $classificacoes = array();
    $estabelecimentos = array();

    if ($result_cat->num_rows > 0) {
        while ($row = $result_cat->fetch_assoc()) {
            $categorias[] = $row['categoria_nome'];
        }
    }else {
        $categorias[] = "Nenhuma categoria encontrada.";
    }

    if ($result_classf->num_rows > 0) {
        while ($row = $result_classf->fetch_assoc()) {
            $classificacoes[] = $row['classificacao_faixa_etaria'];
        }
    }else {
        $classificacoes[] = "Nenhuma classificação encontrada.";
    }

    if ($result_estab->num_rows > 0) {
        while ($row = $result_estab->fetch_assoc()) {
            $estabelecimentos[] = $row['estabelecimento_nome'];
        }
    }else {
        $estabelecimentos[] = "Nenhum estabelecimento encontrado.";
    }

    $conn -> close();
} else {
    header("Location: login.php");
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Novo Evento</title>
    <link rel="stylesheet" href="styles/telacadastro.css">
</head>

<body>
    <header>
    <div class="header">
        <a href="index.php">Home</a>
        <a href="eventos.php">Eventos</a>
        
    </div>
        <div class="title">
        <h1>Criar Novo Evento</h1> 
        </div>
    </header>

    <form action="envioevento.php" method="post">
        <label for="nome">Nome do Evento:</label>
        <input type="text" id="nome" name="nome" required>

        <label for="descricao">Descrição:</label>
        <textarea id="descricao" name="descricao" rows="4" required></textarea>

        <label for="data">Data:</label>
        <input type="date" id="data" name="data" required>

        <label for="hora">Hora do Evento:</label>
        <input type="time" id="hora" name="hora" required>

        <label for="preco">Preço:</label>
        <input type="number" id="preco" name="preco" step="0.01" required>

        <label for="categoria">Categoria:</label>
        <select id="categoria" name="categoria" required>
            <option value = "">Selecione a categoria</option>
            <?php for($i = 0; $i < count($categorias); $i++) : ?>
                            <option value = <?php echo $categorias[$i]; ?>><?php echo $categorias[$i]; ?></option>
                        <?php endfor; ?>
                        </select>
        <label for="classificação">Classificação:</label>
        <select id="classificação" name="classificação" required>
            <option value = "">Selecione a classificação</option>
            <?php for($i = 0; $i < count($classificacoes); $i++) : ?>
                        <option value = <?php echo $classificacoes[$i]; ?>><?php echo $classificacoes[$i]; ?></option>
                    <?php endfor; ?>
                    </select>
        <label for="estabelecimento">Estabelecimento:</label>
        <select id="estabelecimento" name="estabelecimento" required>
            <option value = "">Selecione o estabelecimento</option>
            <?php for($i = 0; $i < count($estabelecimentos); $i++) : ?>
                            <option value = <?php echo $estabelecimentos[$i]; ?>><?php echo $estabelecimentos[$i]; ?></option>
                        <?php endfor; ?>
                        </select>

        <label for="imagem">Imagem:</label>
        <input type="file" id="imagem" name="imagem" accept="image/*" onchange="previewImage()">
        <img id="preview" src="#" alt="Preview da Imagem" style="display: none; max-width: 200px; margin-top: 10px;">

        <input type="submit" value="Criar Evento">
    </form>
    <script>
        function previewImage() {
            var input = document.getElementById('imagem');
            var preview = document.getElementById('preview');

            var file = input.files[0];
            var reader = new FileReader();

            reader.onload = function (e) {
                preview.src = e.target.result;
                preview.style.display = 'block';

                // Convertendo a imagem para bytes (base64)
                var imageData = e.target.result.split(',')[1];
                document.getElementById('eventoForm').setAttribute('data-imagem', imageData);
            };

            reader.readAsDataURL(file);
        }
    </script>
</body>

</html>

