<?php
#echo '<pre>';print_r($_REQUEST);exit;

require '../../classes/sql.class.php';

$sql = new SQL();



$validarMatricula = $sql->validarMatricula($_REQUEST['mat']);



if(!empty($validarMatricula)){

    echo '<script>

    alert("Login ja cadastrado!"); 

    window.history.go(-1);

    </script>';die();

}





$insertUsuarioAutonomo = $sql->insertUsuarioAutonomo($_REQUEST);

if($insertUsuarioAutonomo['informacao'] == 'SUCESSO'){

    echo '<script>

    alert("cadastrado com sucesso! usuario e senha = login"); 

    window.history.go(-2);

    </script>';die();

}











