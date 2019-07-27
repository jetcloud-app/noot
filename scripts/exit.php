<?php
// Inicia a sessão
session_start();

// Destrói a sessão
$_SESSION = array();
session_destroy();

// Redireciona para o login.php
header('location: ../?op=58D137C8D689101F631B1EC7130BE1B6');