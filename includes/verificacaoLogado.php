<?php

if($_SESSION['usuario']['logado'] != 'sim'){
    header("Location: login.php");
}

exit;

