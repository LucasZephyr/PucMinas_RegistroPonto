<?php
$tempo = 7200; #duas horas
session_set_cookie_params($tempo);
session_start();
if(!$_SESSION['usuario']['logado'] == 'sim'){
    header("Location: login.php");
}


?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Ver detalhes contas</title>
    
    <?php include '../includes/cabecalho.php';?>
    <script defer src="../assets/js/gestor/alterarSenha.js"></script>

</head>

<body>

    <?php include '../includes/navBar.php'?>
    <?php include '../includes/menuLateral.php'?>


    <!-- Inicio menu Principal-->
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Alterar Senha</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">inicio</a></li>
                    <li class="breadcrumb-item">Conta</li>
                    <li class="breadcrumb-item active">Alterar Senha</li>
                </ol>
            </nav>
        </div>

        <section class="section dashboard">
            <div class="row">
                <div class="col-lg-11"> <!-- inicio coluna a esquerda-->
                    <div class="row">

                    <div class="card">
                        <h5 class="card-header">Atualize seus dados, caso necessário.</h5>
                        <div class="card-body">


                            <form class="row" name="formAlterarSenha" id="formAlterarSenha">

                                <div class="col-md-4 mt-4">
                                    <label class="form-label">Senha Antiga</label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="verSenha1"><i class="bi bi-eye-fill"></i></span>
                                        <input type="password" name="senha1" id="senha1" class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-4 mt-4">
                                    <label class="form-label">Nova Senha</label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="verSenha2"><i class="bi bi-eye-fill"></i></span>
                                        <input type="password" name="senha2" id="senha2" class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-4 mt-4">
                                    <label class="form-label">Confirme a Nova Senha</label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="verSenha3"><i class="bi bi-eye-fill"></i></span>
                                        <input type="password" name="senha3" id="senha3" class="form-control">
                                    </div>
                                </div>

                                <p id="msgSenha"></p>
                                <p id="msgSenhaInformativo" style="color: red"></p>
                                <p id="nivelSenha"></p>

                                <div class="progress mt-3">
                                    <div id="senhaProgressBar" class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>



                              <div class="col-12 mt-3 ">
                                <button class="btn btn-primary" id="btnAtualizarSenha" type="button" disabled>Atualizar</button>
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