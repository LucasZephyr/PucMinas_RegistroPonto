<?php
session_start();

include '../../classes/sql.class.php';

#ini_set('display_errors', 1);
#error_reporting(E_ALL);
#echo "<pre>";print_r($_REQUEST);exit;


if ($_SERVER['REQUEST_METHOD'] === 'POST') { #inicio validacao csrf_token
    # Verificar o token CSRF

    
    if (!isset($_REQUEST['csrf_token']) != $_SESSION['csrf_token']) {
        # Token CSRF invalido, redirecionar o usuario para uma pagina login

        $_SESSION['erro'] = 1; #erro 1 csrf
        header('Location: https://zephyrpa.online/gestor/login.php?erro=1');
        exit();

    }
    



    # Inicio validação força bruta
    $maxTentativas = 10; # número máximo de tentativas de login permitidas
    $tempoBloqueado = 60 * 30; # tempo de bloqueio em segundos (30 minutos)


    # Verificar se o usuario excedeu o limite de tentativas de login
    if ($_SESSION['tentativas_login'] >= $maxTentativas) {
        # O usuario excedeu o número máximo de tentativas de login
        if (time() - $_SESSION['ultimas_tentativas_login'] < $tempoBloqueado) {
            
            # Ainda está no período de bloqueio, redirecionar o usuário para uma página de erro
            $_SESSION['erro'] = 3; #forca bruta
            header('Location: https://zephyrpa.online/gestor/login.php?erro=3');
            exit();

        } else {
            # Período de bloqueio expirou, resetar as tentativas de login
            unset($_SESSION['tentativas_login']);
            unset($_SESSION['ultimas_tentativas_login']);
        }
    }



    $login = $_POST['matricula'];
    $senha = $_POST['senha'];

    
    if (verificar_credenciais($login, $senha)) {

        # Login bem sucedido, resetar as tentativas de login
        unset($_SESSION['tentativas_login']);
        unset($_SESSION['ultimas_tentativas_login']);

        header("Location: https://zephyrpa.online/gestor/index.php");
        exit;


    } else {


        # Login falhou, incrementar o número de tentativas de login
        if (!isset($_SESSION['tentativas_login'])) {
            $_SESSION['tentativas_login'] = 1;
            $_SESSION['ultimas_tentativas_login'] = time(); #em unix

        } else {

            $_SESSION['tentativas_login']++;
            
        }



        #exit('brute force');

        # Redirecionar o usuario de volta para a página de login com uma mensagem de erro
        $_SESSION['erro'] = 2; #login incorreto
        header('Location: https://zephyrpa.online/gestor/login.php?erro=2');
        exit();



    }#fim validação força bruta

} #fim validacao csrf_token





#funções de validação
function verificar_credenciais($matricula, $senha) {

    $oSQL = new sql();

    $verificaLogin = $oSQL->verificarLogin($matricula, $senha);
    #echo "<pre>";print_r($verificaLogin);exit;

    $configSis = $oSQL->getDadosSistema();

    if(empty($verificaLogin)){

        $_SESSION['usuario']['logado'] = 'nao';
        return false;

    }else{


        $_SESSION['usuario']['logado'] = 'sim';
        $_SESSION['usuario']['id_usuario'] = $verificaLogin[0]['id_usuario'];
        $_SESSION['usuario']['login'] = $verificaLogin[0]['login'];
        $_SESSION['usuario']['senha'] = $verificaLogin[0]['senha'];
        $_SESSION['usuario']['email'] = $verificaLogin[0]['email'];
        $_SESSION['usuario']['cpf'] = $verificaLogin[0]['cpf'];
        $_SESSION['usuario']['nome'] = $verificaLogin[0]['nome'];
        $_SESSION['usuario']['telefone'] = $verificaLogin[0]['telefone'];
        $_SESSION['usuario']['primeiro_acesso'] = $verificaLogin[0]['primeiro_acesso'];
        $_SESSION['usuario']['perfil'] = $verificaLogin[0]['perfil'];
        $_SESSION['usuario']['setor'] = $verificaLogin[0]['setor'];
        $_SESSION['usuario']['funcao'] = $verificaLogin[0]['funcao'];
        $_SESSION['usuario']['data_nascimento'] = $verificaLogin[0]['data_nascimento'];
        $_SESSION['usuario']['login'] = $verificaLogin[0]['login'];

        $_SESSION['config']['nome']         = $configSis[0]['nomeSistema'];
        $_SESSION['config']['titulo']       = $configSis[0]['titulo'];
        $_SESSION['config']['subtitulo']    = $configSis[0]['subtitulo'];
        $_SESSION['config']['icone']        = $configSis[0]['icone'];
        $_SESSION['config']['descricao']    = $configSis[0]['descricao'];



        return true;
        
    }


}



?>