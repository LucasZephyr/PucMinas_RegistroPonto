<?php
#ini_set('display_errors',1);
#ini_set('display_startup_erros',1);
#error_reporting(E_ALL);


$tempo = 7200; #duas horas
session_set_cookie_params($tempo);
session_start();

if($_SESSION['usuario']['logado'] == 'sim'){
    header("Location: index.php");
}



//criação do token para bloquear ataques de CSRF
$csrf_token = hash('SHA512', md5(uniqid()));
$_SESSION['csrf_token'] = $csrf_token;

/*
* erro=1 | Token CSRF invalido
* erro=2 | LOGIN INVALIDO
* erro=3 | BLOQUEADO POR TENTATIVA DE FORÇA BRUTA
*/

$data_formatada = date('d/m/Y H:i:s', $_SESSION['ultimas_tentativas_login']);
#echo $data_formatada;exit;

#echo "<pre>";print_r($_SESSION);exit;

if(!$_SESSION['erro']){
    $_SESSION['erro'] = 0;
}


require '../classes/sql.class.php';
$sql = new SQL();
$dadosConfig = $sql->getDadosSistema();


if($dadosConfig[0]['icone'] != ''){
    $imgBrasaoNav = $dadosConfig[0]['icone'];

    $nomeSistema = $dadosConfig[0]['nomeSistema'];
    $titulo = $dadosConfig[0]['titulo'];
    $subtitulo = $dadosConfig[0]['subtitulo'];
    $descricao = $dadosConfig[0]['descricao'];


}else{
    
    $nomeSistema = $_SESSION['config']['nome'];
    $titulo = $_SESSION['config']['titulo'];
    $subtitulo = $_SESSION['config']['subtitulo'];
    $descricao = $_SESSION['config']['descricao'];
}


?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Gestor</title>

    <style>
        input::placeholder {
            color: gray;
            font-family: Arial;
            text-align: center;
            font-weight: 100;
            font-size: 18px;
        }
    </style>
    
    <?php include '../includes/cabecalho.php'; ?>
</head>
<body>

<header id="header" class="header fixed-top d-flex align-items-center">

<div class="d-flex align-items-center justify-content-between">
    <a href="index.php" class="logo d-flex align-items-center">
        <img src="../assets/img/<?=$imgBrasaoNav?>" alt="">
        <span class="d-none d-lg-block"><?=$nomeSistema?></span>
    </a>
</div>


<nav class="header-nav ms-auto">
    <ul class="d-flex align-items-center">

        <div id="relogio" style="margin-right: 40px; color: #000000; font-size: 21px; font-weight: 100;">

        </div>

    </ul>
</nav>
</header>

    <!-- Inicio menu Principal-->
<main id="main" class="main">
   <section class="section dashboard">
      <div class="row">

         <div class="col-lg-12">
            <!-- inicio coluna a esquerda-->
            <div class="row">

                <!-- Card 'LOGIN' -->
                <div class="col-xxl-9 col-md-8"> <!--TAMANHO DO CARD -->
                  <div class="card info-card sales-card">


                     <div class="card-body">
                        <section class="ftco-section">
                           <div class="container">

                              <div class="row justify-content-center">
                                 <div class="col-md-7 col-lg-10"> <!-- TAMANHO DOS INPUTS-->
                                    <div class="login-wrap p-4 p-md-5">


                                       <h3 class="text-center mb-4"><?=$titulo?><br>
                                            <b style="color: #012970; font-family: 'Nunito', sans-serif'";><?=$subtitulo?></b>
                                        </h3>


                                        <form action="processa/processa_login.php" class="login-form" method="post">
                                            <div class="form-group">
                                                 <input type="text" name="matricula" class="form-control rounded-left" placeholder="Matrícula" required="">
                                            </div>

                                            <br>

                                            <div class="form-group d-flex">
                                                 <input type="password" name="senha" class="form-control rounded-left" placeholder="Senha" required="">
                                            </div>


                                            <br><br>


                                            <div class="form-group">
                                                <button type="submit" class="form-control btn btn-primary rounded submit px-3">Login</button>
                                            </div>
                                            <br>


                                            <div class="w-100 text-md-left">
                                                <i class="bi bi-circle"></i> <a href="procotocoloRecuperarSenha.php">Esqueci minha senha!</a><br><br>
                                                <i class="bi bi-circle"></i> <a href="criarConta.php">Criar Conta</a>
                                            </div>

                                            <?php if($_SESSION['erro'] == 2){?>
                                                <div class="w-100 text-md-right">
                                                    <p style="color: red; text-align: center; margin-top: 20px;">
                                                        Login Inv&aacute;lido
                                                    </p>
                                                </div>
                                            <?php } ?>
                                            <?php if($_SESSION['erro'] == 3){?>
                                                <div class="w-100 text-md-right">
                                                    <p style="color: red; text-align: center; margin-top: 20px;">
                                                        Login bloqueado por questões de segurança.<br>
                                                        Aguarde 30 minutos para tentar novamente!
                                                    </p>
                                                </div>
                                            <?php } ?>

                                            <div>
                                                <p style="color: black; text-align: justify; margin-top: 40px;">
                                                    <?=$descricao?>
                                                </p>
                                            </div>
                                            

                                          </div>

                                            <input type="hidden" name="csrf_token" value="<?=$csrf_token;?>">
                                       </form>


                                    </div>
                                 </div>
                              </div>
                           </div>
                        </section>
                     </div>
                  </div>
               </div><!-- FIM Card LOGIN -->
               
            </div>
         </div>
      </div>
   </section>
</main>


<!-- FIM DO MENU PRINCIPAL -->
<footer id="footer" class="footer" style="margin: 0 auto;">
    <div class="copyright">
         © <?=date('Y')?> Zephyr. Todos os direitos reservados.
    </div>
</footer>

<script>
function atualizarRelogio() {
    var agora = new Date();
    var horas = agora.getHours();
    var minutos = agora.getMinutes();
    var segundos = agora.getSeconds();


    //se a hora for menor que 10 adiciono um zero a frente
    if (horas < 10) {
    horas = "0" + horas;
    }

    if (minutos < 10) {
    minutos = "0" + minutos;
    }

    if (segundos < 10) {
    segundos = "0" + segundos;
    }

    var horaAtual = horas + ":" + minutos + ":" + segundos;

    document.getElementById("relogio").innerHTML = horaAtual;
}

setInterval(atualizarRelogio, 1000); // chama a função a cada segundo

</script>


</body>
</html>