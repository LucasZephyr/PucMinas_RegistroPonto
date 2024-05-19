<?php
$tempo = 7200; #duas horas
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

$getDadosSistema = $sql->getDadosSistema();



?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Ver Ferias Solic </title>

    <script defer src="../assets/js/gestor/gerenciarFerias.js"></script>
    
    <?php include '../includes/cabecalho.php'?>
</head>

<body>

    <?php include '../includes/navBar.php'?>

    <?php include '../includes/menuLateral.php'?>


    <!-- Inicio menu Principal-->
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Alterar dados do sistema</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">inicio</a></li>
                    <li class="breadcrumb-item">Configurações</li>
                    <li class="breadcrumb-item active">Configuraçoes do sistema</li>
                </ol>
            </nav>
        </div>

        <section class="section dashboard">
            <div class="row">
                <div class="col-lg-12"> <!-- inicio coluna a esquerda-->
                    <div class="row">
                        <div class="card">
                            <h5 class="card-header">Preencha os Campos abaixo</h5>
                            <div class="card-body mt-3">

                                <h5>Preencha os campos com os dados que convém a sua equipe</h5>

                                <form class="row g-3" action="processaConfig.php" method="post" enctype="multipart/form-data">

                                    <div class="col-md-4">
                                        <label for="" class="form-label">Nome do sistema</label>
                                        <input maxlength="30" type="text" class="form-control" name="nomeSistema" value="<?=$getDadosSistema[0]['nomeSistema']?>">
                                    </div>

                                    <div class="col-md-8">
                                        <label for="" class="form-label">Ícone do sistema</label>
                                        <input type="file" class="form-control" name="icone" accept="image/*" required>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="" class="form-label">Título (login)</label>
                                        <input maxlength="20" type="text" class="form-control" name="titulo" value="<?=$getDadosSistema[0]['titulo']?>">
                                    </div>

                                    <div class="col-md-6">
                                        <label for="" class="form-label">Subtítulo (login)</label>
                                        <input maxlength="15" type="text" class="form-control" name="subtitulo" value="<?=$getDadosSistema[0]['subtitulo']?>">
                                    </div>

                                    <div class="col-md-12">
                                        <label for="" class="form-label">Descrição informativa (Login)</label>
                                        <textarea maxlength="255" class="form-control" name="descricao" placeholder="recomendo fazer uma pequena descrição sobre o processo de login ou informar no número de contato para ter acesso ao login."><?=utf8_encode($getDadosSistema[0]['descricao'])?></textarea>
                                    </div>

                                    
                                    <div class="col-12">
                                        <button class="btn btn-primary" type="submit">Alterar</button>
                                    </div>
                                </form>
                                
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </section>

    </main><!-- FIM DO MENU PRINCIPAL -->

    <!-- ======= RODAPÉ ======= -->
    <?php include "../includes/rodape.php";?>

</body>

</html>