<?php

session_start();

if (isset($_SESSION['auth_response']) && $_SESSION['auth_response']['sucess'] === false) {
    $check_login = $_SESSION['auth_response']['message'];
    unset($_SESSION['auth_response']);
}
else{$check_login = "Insira seu login e senha:";}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/login.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <title>Cadastre-se</title>
</head>

<body>
    <div class="header">
        <a href="index.php">Home</a>
        <a href="eventos.php">Eventos</a>
    </div>

    <div class=container-geral>

        <div class="container-login">
        
            <form id="loginForm" class="formulario-login" action="auth.php" method="post">
                <h2 class="titulo_form">Iniciar sessão</h2>
                <div class="iconos">
                    <div class="border-icon">
                        <i class='bx bxl-instagram'></i>
                    </div>
                    <div class="border-icon">
                        <i class='bx bxl-linkedin' ></i>
                    </div>
                    <div class="border-icon">
                        <i class='bx bxl-facebook-circle' ></i>
                    </div>
                </div>
                <p class="subtitulo_form"> <?php echo $check_login?> </p>
                <input type="email" name="email" id="emailInput" placeholder="Email">
                <input type="password" name="senha" id="senhaInput" placeholder="Senha">
                <input type="submit" value="Iniciar sessão">
            </form>
            <div id="w_login" class="welcome-login">
                <div class="message">
                    <h2>Bem vindo de volta!</h2>
                    <p>Se ja tem uma conta, inicie a sessão aqui.</p>
                    <button id="signInBtn" class="sign-in-btn">Iniciar sessão</button>
                </div>
            </div>
        </div>

        <div class="container-cadastro">
            
            <form id="registerForm" class="formulario-registro">
                <h2 class="titulo_form">Criar uma conta</h2>
                <div class="iconos">
                    <div class="border-icon">
                        <i class='bx bxl-instagram'></i>
                    </div>
                    <div class="border-icon">
                        <i class='bx bxl-linkedin' ></i>
                    </div>
                    <div class="border-icon">
                        <i class='bx bxl-facebook-circle' ></i>
                    </div>
                </div>
                <p class="subtitulo_form">Ainda não tem conta?</p>
                <p class="subtitulo_form">Insira seus dados abaixo:</p>
                <input type="text" placeholder="Nome">
                <input type="email" placeholder="Email">
                <input type="password" placeholder="senha">
                <input type="submit" value="Registrar-se">
            </form>
            <div id="w_reg" class="welcome-register">
                <div class="message">
                    <h2>Bem vindo</h2>
                    <p>Se ainda não tem conta registre-se aqui</p>
                    <button id="signUpBtn" class="sign-up-btn">Registrar-se</button>
                </div>
            </div>
        </div>


    </div>
    
    
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var logindiv = document.getElementById('w_login');
            var regdiv = document.getElementById('w_reg');
            var signInBtn = document.getElementById('signInBtn');
            var signUpBtn = document.getElementById('signUpBtn');
            var loginForm = document.getElementById('loginForm');
            var registerForm = document.getElementById('registerForm');
            var welcomeLogin = document.querySelector('.welcome-login');
            var welcomeRegister = document.querySelector('.welcome-register');

            // Função para alternar entre os formulários
            function toggleForms(showLoginForm) {
                welcomeLogin.classList.toggle('welcome-login-hidden', showLoginForm);
                welcomeRegister.classList.toggle('welcome-register-hidden', !showLoginForm);
                loginForm.style.display = showLoginForm ? 'block' : 'none';
                registerForm.style.display = showLoginForm ? 'none' : 'block';
            }

            // Função para salvar o estado no localStorage
            function saveState(showLoginForm) {
                localStorage.setItem('showLoginForm', showLoginForm);
            }

            // Função para carregar o estado do localStorage ou definir um estado padrão
            function loadState() {
                var showLoginForm = localStorage.getItem('showLoginForm');

                // Verifica se o valor é nulo ou indefinido
                if (showLoginForm === null || showLoginForm === undefined) {
                    // Nenhum valor salvo na localStorage, define um estado padrão
                    showLoginForm = true; // ou false, dependendo do seu requisito padrão
                } else {
                    // Converte a string para um boolean
                    showLoginForm = showLoginForm === 'true';
                    toggleForms(showLoginForm);
                }

                
            }

            // Adiciona manipuladores de evento para os botões
            signInBtn.addEventListener('click', function () {
                logindiv.style.visibility = 'hidden';
                regdiv.style.visibility = 'visible';

                // Adiciona uma classe de transição
    

                toggleForms(true);
                saveState(true);

            });

            signUpBtn.addEventListener('click', function () {
                logindiv.style.visibility = 'visible';
                regdiv.style.visibility = 'hidden';

                toggleForms(false);
                saveState(false);

            });

            // Carrega o estado salvo ou define o estado padrão ao carregar a página
            loadState();

            // Adiciona um evento para verificar se a página está sendo recarregada
            window.addEventListener('unload', function () {
                // Salva o estado antes de recarregar a página
                var showLoginForm = localStorage.getItem('showLoginForm');
                if (showLoginForm !== null && showLoginForm !== undefined) {
                    localStorage.setItem('showLoginForm', showLoginForm);
                }
            });
                });
    </script>
</body>

</html>