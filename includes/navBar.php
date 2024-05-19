<?php
    if($dadosConfig[0]['icone'] != ''){
        $imgBrasaoNav = $dadosConfig[0]['icone'];
        $nomeSistema = $dadosConfig[0]['nomeSistema'];
    }else{
        $imgBrasaoNav = $_SESSION['config']['icone'];
        $nomeSistema = $_SESSION['config']['nome'];
    }
?>
    <!-- ======= cabecalho ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">

        <div class="d-flex align-items-center justify-content-between">
            <a href="index.php" class="logo d-flex align-items-center">
                <img src="../assets/img/<?=$imgBrasaoNav?>" alt="">
                <span class="d-none d-lg-block"><?=$nomeSistema?></span>
            </a>
            <i class="bi bi-list toggle-sidebar-btn"></i>
        </div>


        <nav class="header-nav ms-auto row">
            <ul class="d-flex align-items-center">

                <li style="margin-right: 25px;">
                    <a href="logout.php" class="btn btn-danger">
                        <i class="bi bi-box-arrow-right"></i> Sair
                    </a>
                </li>

            </ul>
        </nav>
    </header>
    <!-- FIM CABECALHO-->