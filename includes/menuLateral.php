<?php 
    $liberadoSubMenu = false;
    if($_SESSION['usuario']['perfil'] == 2){
        $liberadoSubMenu = true;
    }
?>


<!-- ======= menuLateral ======= -->
<aside id="sidebar" class="sidebar">

<ul class="sidebar-nav" id="sidebar-nav">

    <li class="nav-item">
        <a class="nav-link " href="index.php" style="color: #012970;">
            <i class="bi bi-grid"></i>
            <span>Inicio</span>
        </a>
    </li>

     <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#pontoEletronico" href="#" id="acaoPontoEletronico">
            <i class="bi bi-pin-map"></i><span>Ponto Eletrônico</span><i
                class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="pontoEletronico" class="nav-content collapse" data-bs-parent="#pontoEletronico">
            <li>
                <a href="registrarPontoEletronico.php">
                    <i class="bi bi-circle"></i><span>Registrar Ponto Eletrônico</span>
                </a>
            </li>

            <li>
                <a href="solitarAbono.php">
                    <i class="bi bi-circle"></i><span>Solicitar Abono</span>
                </a>
            </li>

            <li>
                <a href="verAbonosSolicitados.php">
                    <i class="bi bi-circle"></i><span>Lista de Abonos Solicitados</span>
                </a>
            </li>

            <?php if($liberadoSubMenu){ ?>
                <li>
                    <a href="controleAbonoADM.php">
                        <i class="bi bi-circle"></i><span>Controle de Abonos (ADM)</span>
                    </a>
                </li>
            <?php } ?>

        </ul>
    </li>


    <?php if($liberadoSubMenu){ ?>
    <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#cadastro" href="#" id="acaoCadastro">
            <i class="bi bi-person"></i><span>Usu&aacute;rios</span><i
                class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="cadastro" class="nav-content collapse" data-bs-parent="#cadastro">
            <li>
                <a href="cadastrarUsuario.php">
                    <i class="bi bi-circle"></i><span>Cadastrar Usuário</span>
                </a>
            </li>
            <li>
                <a href="gestaoUsuarios.php">
                    <i class="bi bi-circle"></i><span>Gerenciar Usu&aacute;rios</span>
                </a>
            </li>
        </ul>
    </li>
    <?php } ?>

    <?php if($liberadoSubMenu){ ?>
    <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#consultas" href="#" id="acaoConsultas">
            <i class="bi bi-calendar3"></i><span>Consultas</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="consultas" class="nav-content collapse " data-bs-parent="#sidebar-nav">
            <li>
                <a href="consultaExpediente.php">
                    <i class="bi bi-circle"></i><span>Relat&oacute;rio de Férias</span>
                </a>
            </li>

            <li>
                <a href="relAbonos.php">
                    <i class="bi bi-circle"></i><span>Relat&oacute;rio de Abonos</span>
                </a>
            </li>
        </ul>
    </li>
    <?php } ?>


    <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#servidores" href="#" id="acaoServidores">
            <i class="bi bi-people"></i><span>F&eacute;rias</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="servidores" class="nav-content collapse " data-bs-parent="#sidebar-nav">

            <li>
                <a href="solicFerias.php">
                    <i class="bi bi-circle"></i><span>Solicitar F&eacute;rias</span>
                </a>
            </li>

            <li>
                <a href="verFeriasSolic.php">
                    <i class="bi bi-circle"></i><span>Ver F&eacute;rias Solicitadas</span>
                </a>
            </li>


            <?php if($liberadoSubMenu){ ?>
            <li>
                <a href="gerenciarFerias.php">
                    <i class="bi bi-circle"></i><span>Gerenciar F&eacute;rias</span>
                </a>
            </li>
            <?php } ?>
        </ul>
    </li>


    <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#relatorios" href="#" id="acaoRelatorios">
            <i class="bi bi-newspaper"></i><span>Conta</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="relatorios" class="nav-content collapse " data-bs-parent="#sidebar-nav">
            <li>
                <a href="detalhesConta.php">
                    <i class="bi bi-circle"></i><span>Minha Conta</span>
                </a>
            </li>

            <li>
                <a href="alterarSenha.php">
                    <i class="bi bi-circle"></i><span>Alterar Senha</span>
                </a>
            </li>
        </ul>
    </li>


    <?php if($liberadoSubMenu){ ?>
    <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#configuracoesAba" href="#" id="acaoConfiguracoesAba">
        <i class="bi bi-gear"></i><span>Configurações</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="configuracoesAba" class="nav-content collapse " data-bs-parent="#sidebar-nav">
            <li>
                <a href="gerenciarConfig.php">
                    <i class="bi bi-circle"></i><span>Configuraçoes do sistema</span>
                </a>
            </li>
        </ul>
    </li>
    <?php } ?>



</ul>

</aside><!-- FIM menuLateral-->


<script>
//funcaoes click para fechar e abrir as listas do sidebar

//pontoEletronico
$("#acaoPontoEletronico").click(function() {
    let cadastroLista = $("#pontoEletronico").hasClass('show');
    if(cadastroLista){
        $("#pontoEletronico").removeClass('show');
    }else{
        $("#pontoEletronico").addClass('show');
    }
});

$("#acaoCadastro").click(function() {
    let cadastroLista = $("#cadastro").hasClass('show');
    if(cadastroLista){
        $("#cadastro").removeClass('show');
    }else{
        $("#cadastro").addClass('show');
    }
});

//consulta
$("#acaoConsultas").click(function() {
    let cadastroLista = $("#consultas").hasClass('show');
    if(cadastroLista){
        $("#consultas").removeClass('show');
    }else{
        $("#consultas").addClass('show');
    }
});

//servidores
$("#acaoServidores").click(function() {
    let cadastroLista = $("#servidores").hasClass('show');
    if(cadastroLista){
        $("#servidores").removeClass('show');
    }else{
        $("#servidores").addClass('show');
    }
});

//relatorios
$("#acaoRelatorios").click(function() {
    let cadastroLista = $("#relatorios").hasClass('show');
    if(cadastroLista){
        $("#relatorios").removeClass('show');
    }else{
        $("#relatorios").addClass('show');
    }
});

//
$("#acaoConfiguracoesAba").click(function() {
    let cadastroLista = $("#configuracoesAba").hasClass('show');
    if(cadastroLista){
        $("#configuracoesAba").removeClass('show');
    }else{
        $("#configuracoesAba").addClass('show');
    }
});
</script>