<div class="col-lg-8"> <!-- inicio coluna a esquerda-->
    <div class="row">

        <!-- Início do Painel de Registros de Ponto -->
        <div class="col-xxl-6 col-md-6">
            <div class="card info-card sales-card">
                <div class="card-body">
                    <h5 class="card-title">Total de Registros de Ponto</h5>
                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-arrow-up-circle-fill"></i>
                        </div>
                        <div class="ps-3">
                            <h6><?php echo $registros_ponto[0]['total_registros_ponto']; ?> batidas registradas</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Fim do Painel de Registros de Ponto -->

        <!-- Início do Painel de Abonos Pendentes -->
        <div class="col-xxl-6 col-md-6">
            <div class="card info-card sales-card">
                <div class="card-body">
                    <h5 class="card-title">Solicita&ccedil;&otilde;es de Abonos Pendentes</h5>
                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-arrow-up-circle-fill"></i>
                        </div>
                        <div class="ps-3">
                            <h6><?php echo $abonos_pendentes[0]['total_abonos_pendentes']; ?> Abonos</h6>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Fim do Painel de Abonos Pendentes -->

        <!-- Inicio do Painel de Informacao dos Usuarios -->
        <div class="col-xxl-6 col-xl-12">
            <div class="card info-card customers-card">
                <div class="card-body">
                    <h5 class="card-title">Usu&aacute;rios Atrasados</h5>
                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-people"></i>
                        </div>
                        <div class="ps-3">
                            <h6>Vezes que colaboradores se atrasaram: <?php echo $atrasoEntrada[0]['qtd_atraso_na_entrada']; ?></h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Fim do Painel de Informaca dos usuarios -->


        <!-- Inicio do Painel de Ferias Solicitadas -->
        <div class="col-xxl-6 col-md-6">
            <div class="card info-card sales-card">
                <div class="card-body">
                    <h5 class="card-title">Número de Ferias Solicitadas</h5>
                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-arrow-up-circle-fill"></i>
                        </div>
                        <div class="ps-3">
                            <h6><?=$totalFeriasSolic[0]['ferias']?> Ferias</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
</div><!-- fim coluna a esquerda -->





<!-- inicio coluna a direita-->
<div class="col-lg-4">
    <div class="card">
        <div class="card-body pb-0">
            <h5 class="card-title"> Rela&ccedil;&atilde;o de usu&aacute;rios ativos e inativos </span></h5>

            <div id="trafficChart" style="min-height: 400px;" class="echart"></div>

            <script>
                document.addEventListener("DOMContentLoaded", () => {
                    echarts.init(document.querySelector("#trafficChart")).setOption({
                        tooltip: {
                            trigger: 'item'
                        },
                        legend: {
                            top: '5%',
                            left: 'center'
                        },
                        series: [{
                            //name: 'nome editavel aqui',
                            type: 'pie',
                            radius: ['40%', '70%'],
                            avoidLabelOverlap: false,
                            label: {
                                show: false,
                                position: 'center'
                            },
                            emphasis: {
                                label: {
                                    show: true,
                                    fontSize: '18',
                                    fontWeight: 'bold'
                                }
                            },
                            labelLine: {
                                show: false
                            },
                            data: [<?=$dados?>]
                        }]
                    });
                });
            </script>

        </div>
    </div><!-- FIM DASHBOARD -->
    </div><!-- fim coluna a direita -->