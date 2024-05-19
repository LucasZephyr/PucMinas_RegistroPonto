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

require '../assets/fpdf/fpdf.php';

$getDadoFeriasRelatorio = $sql->getDadoFeriasRelatorio();
#echo '<pre>';print_r($getDadoFeriasRelatorio);exit;

class PDF extends FPDF
{

    function Header(){
        $this->SetFont('Arial','B',12);
        $this->Cell(0,6,'PUC Minas',0,1,'C');
        $this->Cell(0,6,date('Y'),0,1,'C');
        $this->Cell(0,6,utf8_decode('Registro de Ponto Eletrônico'),0,1,'C');

        $this->Ln(5);
        $this->Cell(
            35,
            15,
            utf8_decode('Esse documento representa todos os usúarios ativos do sistema com solicitações de ferias pendente.'),
            0,
            1
        );

        $this->Ln(10);

        $this->SetFillColor(220,220,220);
        $this->SetFont('Arial','B',12);
        $this->Cell(100,10,'Nome',1,0,'C', 1);
        $this->Cell(40,10,'CPF',1,0,'C', 1);
        $this->Cell(40,10,utf8_decode('Data de Início'),1,0,'C', 1);
        $this->Cell(38,10,'Adiantamento 13',1,0,'C', 1);
        $this->Cell(25,10,utf8_decode('Duração'),1,0,'C', 1);
        $this->Cell(35,10,'Dias Adicionais',1,1,'C', 1);
    }



    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial','I',8);
        $this->Cell(0,10,'Pagina '.$this->PageNo().'/{nb}',0,0,'C');
    }


    function ChapterBody($getDadoFeriasRelatorio)
    {
        $this->SetFont('Arial','',12);
        foreach($getDadoFeriasRelatorio as $dados)
        {

            $this->SetFont('Arial','',10);
            $this->Cell(100,7,utf8_decode($dados['nome']),1,0);

            $this->SetFont('Arial','',12);
            $this->Cell(40,7,$dados['cpf'],1,0);
            $this->Cell(40,7,date('d/m/Y', strtotime($dados['data_inicio'])),1,0);
            $this->Cell(38,7,$dados['adiantamento_13'],1,0);
            $this->Cell(25,7,$dados['duracao'],1,0);
            $this->Cell(35,7,$dados['dias_adicionais'],1,1);
        }
    }
}

$pdf = new PDF('L');
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','',12);


$pdf->ChapterBody($getDadoFeriasRelatorio);


$nomeArquivo = 'relatorio_ferias_' . date('d/m/Y');


$pdf->Output('I', $nomeArquivo);
?>
