<?php

require '../classes/sql.class.php';
$sql = new SQL();

$tempo = 7200; #duas horas
session_set_cookie_params($tempo);
session_start();
if(!$_SESSION['usuario']['logado'] == 'sim'){
    header("Location: login.php");
}

if($_SESSION['usuario']['perfil'] != '2'){
    header("Location: index.php");
}


$usuarios = $sql->getUsuarios();
#echo '<pre>';print_r($usuarios);echo '</pre>';exit;


?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Gestor</title>
    
    <script defer src="../assets/js/gestor/gestaoUsuarios.js"></script>

    <?php include '../includes/cabecalho.php'?>
</head>

<body>

    <?php include '../includes/navBar.php'?>
    <?php include '../includes/menuLateral.php'?>


    <!-- Inicio menu Principal-->
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Gerenciar Usu&aacute;rios</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">inicio</a></li>
                    <li class="breadcrumb-item">Usuarios</li>
                    <li class="breadcrumb-item active">Gerenciar Usu&aacute;rios</li>
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


                            <div class="table-responsive">
                                <table class="table table-striped" id="usuarios">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Nome</th>
                                            <th scope="col">Login</th>
                                            <th scope="col">Ativo</th>
                                            <th scope="col">Nascimento</th>
                                            <th scope="col">A&ccedil;&atilde;o</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php $i=1; foreach($usuarios as $usuario){  ?>
                                        <tr>                                    
                                            <td><?=$i?></td>
                                            <td><?=$usuario['nome']?></td>
                                            <td><?=$usuario['login']?></td>
                                            <td><?= $usuario['ativo'] == 1 ? 'Ativo' : 'Inativo' ?></td>
                                            <td><?=date('d/m/Y', strtotime($usuario['data_nascimento']))?></td>


                                            <td>
                                                <div class="col-12">
                                                    <button class="btn btn-primary" type="button" value="1" onclick="atualizarStatus(this.value, <?=$usuario['id_usuario']?>, 'Ativar')">
                                                        <i class="bi bi-person-up"></i> Ativar
                                                    </button>
                                                </div>

                                                <div class="col-12 mt-2">
                                                    <button class="btn btn-danger" type="button" value="0" onclick="atualizarStatus(this.value, <?=$usuario['id_usuario']?>, 'Inativar')">
                                                        <i class="bi bi-person-down"></i> Inativar
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php $i++; } ?>
                                    </tbody>
                                </table>
                            </div>


                            


                    

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