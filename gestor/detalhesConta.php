<?php
$tempo = 7200; #duas horas
session_set_cookie_params($tempo);
session_start();
if(!$_SESSION['usuario']['logado'] == 'sim'){
    header("Location: login.php");
}

$data_formatada = date('d/m/Y', strtotime($_SESSION['usuario']['data_nascimento'])); 

if($_SESSION['usuario']['perfil'] == '1'){
    $perfil = 'Comum';
}else{
    $perfil = 'Admin';
}

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Ver detalhes contas</title>
    
    <?php include '../includes/cabecalho.php';?>
    <script defer src="../assets/js/gestor/detalhesConta.js"></script>
    <script src="../assets/jquery/mascaraJquery.js"></script>

</head>

<body>

    <?php include '../includes/navBar.php'?>
    <?php include '../includes/menuLateral.php'?>


    <!-- Inicio menu Principal-->
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Minha Conta</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">inicio</a></li>
                    <li class="breadcrumb-item">Conta</li>
                    <li class="breadcrumb-item active">Minha Conta</li>
                </ol>
            </nav>
        </div>

        <section class="section dashboard">
            <div class="row">
                <div class="col-lg-11"> <!-- inicio coluna a esquerda-->
                    <div class="row">

                    <div class="card">
                        <h5 class="card-header">
				Atualize seus dados, caso necess&aacute;rio<br>
				<span style="color: red; font-size: 13px">*Caso algumas informa&ccedil;&otilde;es n&atilde;o estejam aparecendo, fazer login novamente.</span>
			</h5
                        <div class="card-body">

                            <form class="row" id="formConta" name="formConta" onsubmit="return false;">
                                <div class="col-md-3 mt-3">
                                    <label class="form-label">Matrícula</label>
                                    <div class="input-group has-validation">
                                        <span class="input-group-text" id="inputGroupPrepend"><i class="bi bi-123"></i></span>
                                        <input type="text" name="matricula" class="form-control" 
                                        value="<?=$_SESSION['usuario']['login']?>"
                                        >
                                    </div>
                                </div>

                                <div class="col-md-3 mt-3">
                                    <label class="form-label">CPF</label>
                                    <div class="input-group has-validation">
                                        <span class="input-group-text" id="inputGroupPrepend"><i class="bi bi-123"></i></span>
                                        <input type="text" name="cpf" id="cpf" class="form-control" 
                                        value="<?=$_SESSION['usuario']['cpf']?>"
                                        >
                                    </div>
                                </div>

                                <div class="col-md-6 mt-3">
                                    <label class="form-label">Nome</label>
                                    <div class="input-group has-validation">
                                        <span class="input-group-text" id="inputGroupPrepend"><i class="bi bi-person-fill"></i></span>
                                        <input type="text" name="nome" class="form-control" 
                                        value="<?=$_SESSION['usuario']['nome']?>"
                                        >
                                    </div>
                                </div>

                                <div class="col-md-6 mt-3">
                                    <label class="form-label">Email</label>
                                    <div class="input-group has-validation">
                                        <span class="input-group-text" id="inputGroupPrepend"><i class="bi bi-envelope"></i></span>
                                        <input type="text" name="email" class="form-control" 
                                        value="<?=$_SESSION['usuario']['email']?>"
                                        >
                                    </div>
                                </div>

                                <div class="col-md-3 mt-3">
                                    <label class="form-label">Telefone</label>
                                    <div class="input-group has-validation">
                                        <span class="input-group-text" id="inputGroupPrepend"><i class="bi bi-123"></i></span>
                                        <input type="text" name="telefone" id="telefone" class="form-control" 
                                        value="<?=$_SESSION['usuario']['telefone']?>"
                                        >
                                    </div>
                                </div>

                                <div class="col-md-3 mt-3">
                                    <label class="form-label">Perfil</label>
                                    <div class="input-group has-validation">
                                        <span class="input-group-text" id="inputGroupPrepend"><i class="bi bi-person-fill-gear"></i></span>
                                        <input type="text" name="perfil" class="form-control" disabled
                                        value="<?=$perfil?>"
                                        >
                                    </div>
                                </div>

                                <div class="col-md-4 mt-3">
                                    <label class="form-label">Setor</label>
                                    <div class="input-group has-validation">
                                        <span class="input-group-text" id="inputGroupPrepend"><i class="bi bi-person-vcard-fill"></i></span>
                                        <input type="text" name="setor" class="form-control" disabled
                                        value="<?=$_SESSION['usuario']['setor']?>"
                                        >
                                    </div>
                                </div>

                                <div class="col-md-4 mt-3">
                                    <label class="form-label">Função</label>
                                    <div class="input-group has-validation">
                                        <span class="input-group-text" id="inputGroupPrepend"><i class="bi bi-person-vcard-fill"></i></span>
                                        <input type="text" name="funcao" class="form-control" disabled
                                        value="<?=$_SESSION['usuario']['funcao']?>"
                                        >
                                    </div>
                                </div>

                                <div class="col-md-4 mt-3">
                                    <label class="form-label">Data de Nascimento</label>
                                    <div class="input-group has-validation">
                                        <span class="input-group-text" id="inputGroupPrepend"><i class="bi bi-calendar"></i></span>
                                        <input type="text" name="dtNasc" id="dtNasc" class="form-control" 
                                        value="<?=$data_formatada?>"
                                        >
                                    </div>
                                </div>


                              <div class="col-12 mt-3 ">
                                <button class="btn btn-primary" id="btnAtualizarDados" type="button">Atualizar</button>
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