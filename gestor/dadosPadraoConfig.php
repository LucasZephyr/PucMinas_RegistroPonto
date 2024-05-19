<?php
$tempo = 7200;
session_set_cookie_params($tempo);
session_start();

if(!$_SESSION['usuario']['logado'] == 'sim'){
    header("Location: login.php");
}
if($_SESSION['usuario']['perfil'] != '2'){
    header("Location: index.php");
}


require '../classes/sql.class.php';
$sql = new SQL();

$nomeSistema = 'Registro de Ponto';
$icone = 'brasao.png';
$titulo = 'Registro de Ponto';
$subtitulo = 'Entrar';
$descricao = 'recomendo fazer uma pequena descrição sobre o processo de login ou informar no número de contato para ter acesso ao login.';