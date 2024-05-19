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
#echo '<pre>';print_r($_REQUEST);exit;



if ($_FILES['icone']['error'] == 0) {

    $pastaDestino = '../assets/img/';
    $nomeOriginal = $_FILES['icone']['name'];
    $extensao = pathinfo($nomeOriginal, PATHINFO_EXTENSION);
    $caminhoExistente = $pastaDestino . 'icone.' . $extensao;


    if (file_exists($caminhoExistente)) {
        unlink($caminhoExistente);
    }
    $novoNome = strtolower('icone.' . $extensao);
    $caminhoDestino = $pastaDestino . $novoNome;
    

    if (move_uploaded_file($_FILES['icone']['tmp_name'], $caminhoDestino)) {

        //echo '<script>alert("Sucesso."); window.history.go(-1);</script>';die();

        $atualizaDadosSitema = $sql->atualizaDadosSitema(
            $_REQUEST['nomeSistema'], 
            $novoNome, 
            $_REQUEST['titulo'], 
            $_REQUEST['subtitulo'], 
            $_REQUEST['descricao']
        );
        if($atualizaDadosSitema['informacao'] == 'SUCESSO'){
            echo '<script>alert("Dados atualizados"); window.history.go(-1);</script>';die();
        }else{
            echo '<script>alert("erro ao atualizar. Verifique as permissão de usuario do seu diretorio."); window.history.go(-1);</script>';die();
        }


    } else {
        echo '<script>alert("Erro ao realizar o upload."); window.history.go(-1);</script>';die();
    }


} else {
    echo '<script>alert("Erro ao realizar o upload - FALHA"); window.history.go(-1);</script>';die();
}






