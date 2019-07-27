<?php
    session_start();
    include_once('scripts/functions.php');
    
    if((isset ($_SESSION['usuarioEmail']) == true) and (isset ($_SESSION['usuarioSenha']) == true)) {
      header('location:panel');
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Loterry For ENEM</title>
        <link rel="stylesheet" href="scripts/w3.css">
        <link rel="stylesheet" href="scripts/other.css">
        <script type="text/javascript" src="scripts/functions.js"></script>
    </head>
    <body class="w3-light-grey">
        <?php
            if ($_GET['op'] == '029268F153E04D602BD9FD2BC4209CE2') {
                caixaMensagem ('Usuário ou senha inválido!', 'Erro');
            }
            if ($_GET['op'] == '58D137C8D689101F631B1EC7130BE1B6') {
                caixaMensagem ('Usuário deslogado com sucesso!', 'Mensagem');
            }
        ?>
        <div class="w3-container" style="top: calc(50% - 137.5px); width: 100%; position: absolute;">
            <div class="w3-card-4">
                <div class="w3-container w3-blue-gray">
                  <h2>Login</h2>
                </div>
                <form class="w3-container w3-white" method="POST" action="acess">
                    <p><label>Email</label>
                    <input class="w3-input" type="email" name="email" placeholder="Email" required autofocus></p>
                    <p><label>Senha</label>
                    <input class="w3-input" type="password" name="senha" placeholder="Senha" required></p>
                    <p><input class="w3-check" type="checkbox" name="remember" value="on" checked> Lembrar-se</p>
                    <p><button style="width: 100%" class="w3-blue-gray w3-btn" type="submit">Acessar</button></p>
                </form>
            </div>
        </div>
    </body>
</html>