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

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Usuário</title>
    
    <?php include '../includes/cabecalho.php';?>
    <script defer src="../assets/js/gestor/cadastrarUsuario.js"></script>


</head>

<body>

    <?php include '../includes/navBar.php'?>
    <?php include '../includes/menuLateral.php'?>


    <!-- Inicio menu Principal-->
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Cadastro de Usuário</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">inicio</a></li>
                    <li class="breadcrumb-item">Usuário</li>
                    <li class="breadcrumb-item active">Cadastrar Usuário</li>
                </ol>
            </nav>
        </div>

        <section class="section dashboard">
            <div class="row">
                <div class="col-lg-11"> <!-- inicio coluna a esquerda-->
                    <div class="row">

                    <div class="card">
                        <h5 class="card-header">Preencha os campos abaixo para criar um novo usuário</h5>
                        <div class="card-body">

                            <form class="was-validated" action="#" id="gestorFormCoordenadorID" name="gestorFormCoordenadorName">

                            <div class="row"> <!-- INICIO LINHA 01 -->
                                <div class="col-md-5">
                                    <div class="mb-3">
                                        <label class="form-label">Nome</label>
                                            <input class="form-control" id="nome" name="nome" placeholder="EX: Pedro Almeida" required>
                                        <div class="invalid-feedback">
                                        Por favor! preencha este campo (Nome).
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label class="form-label">Data Nascimento</label>
                                            <input class="form-control" type="date" id="nascimento" name="nascimento" required>
                                        <div class="invalid-feedback">
                                        Por favor! preencha este campo (Nascimento).
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="validationTextarea" class="form-label">Setor</label>
                                            <input class="form-control" id="set" name="set" placeholder="EX: RH" required>
                                        <div class="invalid-feedback">
                                        Por favor! preencha este campo (Setor).
                                        </div>
                                    </div>
                                </div>
                            </div> <!--FIM LINHA 01 -->


                            <div class="row"> <!-- INICIO LINHA 02 -->
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">Matrícula</label>
                                            <input class="form-control" id="mat" name="mat" placeholder="EX: 00121709" required>
                                        <div class="invalid-feedback">
                                        Por favor! preencha este campo (Nome).
                                        </div>
                                    </div>
                                </div>


                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label for="validationTextarea" class="form-label">Função</label>
                                            <input class="form-control" id="func" name="func" placeholder="EX: secretário" required>
                                        <div class="invalid-feedback">
                                        Por favor! preencha este campo (Setor).
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-5">
                                    <div class="mb-4">
                                        <label class="form-label">E-mail</label>
                                            <input class="form-control" id="email" name="email" placeholder="EX: Lucas.almeida@gmail.com" required>
                                        <div class="invalid-feedback">
                                        Por favor! preencha este campo (Email).
                                        </div>
                                    </div>
                                </div>
                            </div> <!--FIM LINHA 02 -->

                            <div class="row"> <!-- INICIO LINHA 02 -->

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="validationTextarea" class="form-label">CPF</label>
                                            <input class="form-control" onkeydown="formataCPF(this.value);" maxlength="14" id="cpf" name="cpf" placeholder="EX: 584.698.948-34" required>
                                        <div class="invalid-feedback">
                                        Por favor! preencha este campo (CPF).
                                        </div>
                                    </div>
                                </div>


                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="validationTextarea" class="form-label">Telefone</label>
                                            <input class="form-control" maxlength="15" id="telefone" name="telefone" placeholder="EX: 91 9 8811 2233" required>
                                        <div class="invalid-feedback">
                                        Por favor! preencha este campo (CPF).
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <label for="validationServer04" class="form-label">Perfil</label>
                                    <select class="form-select is-invalid" id="Perfil" name="Perfil" aria-describedby="perfil" required>
                                      <option selected value="">Selecione</option>
                                      <option value="1">Comum</option>
                                      <option value="2">Admin</option>
                                    </select>
                                </div>




                            </div> <!--FIM LINHA 02 -->


                            <div class="mb-3">
                                <button class="btn btn-primary" id="btnCadastrar" type="button" disabled><i class="bi bi-box-arrow-in-right"></i> Cadastrar</button>
                            </div>
                            </form>
                            
                        </div>
                    </div>


                    </div>
                </div>
            </div>
        </section>

    </main><!-- FIM DO MENU PRINCIPAL -->

<script>
function formataCPF(v){
    v=v.replace(/\D/g,"");                 //Remove tudo o que não é dígito
    v=v.replace(/(\d{3})(\d)/,"$1.$2");      //Coloca um ponto entre o terceiro e o quarto dígitos
    v=v.replace(/(\d{3})(\d)/,"$1.$2");      //Coloca um ponto entre o terceiro e o quarto dígitos
                                                //de novo (para o segundo bloco de números)
    v=v.replace(/(\d{3})(\d{1,2})$/,"$1-$2"); //Coloca um hífen entre o terceiro e o quarto dígitos
    
    let cpf = document.getElementById("cpf");
    cpf.value = v;

}
</script>

    <!-- ======= RODAPÉ ======= -->
    <?php include "../includes/rodape.php";?>


</body>
</html>