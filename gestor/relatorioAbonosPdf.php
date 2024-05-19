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

$getDadoAbonosRelatorio = $sql->getDadoAbonosRelatorio();
#echo


require '../assets/fpdf/fpdf.php';


class PDF extends FPDF
{
    function Header()
    {
        $this->SetFont('Arial','B',12);
        $this->Cell(0,6,'PUC Minas',0,1,'C');
        $this->Cell(0,6,date('Y'),0,1,'C');
        $this->Cell(0,6,utf8_decode('Registro de Solicitações de Abonos'),0,1,'C');

        $this->Ln(5);
        $this->Cell(
            35,
            15,
            utf8_decode('Esse documento representa todos os abonos solicitados pelo usúarios.'),
            0,
            1
        );


        $this->SetFillColor(220,220,220);
        $this->Cell(100,10,'Nome',1,0,'C',1);
        $this->Cell(20,10,'Bat 1',1,0,'C',1);
        $this->Cell(20,10,'Bat 2',1,0,'C',1);
        $this->Cell(20,10,'Bat 3',1,0,'C',1);
        $this->Cell(20,10,'Bat 4',1,0,'C',1);
        $this->Cell(20,10,'Bat 5',1,0,'C',1);
        $this->Cell(20,10,'Bat 6',1,0,'C',1);
        #$this->Cell(40,10,'Justificativa',1,0,'C',1);
        $this->Cell(30,10,'Dia',1,0,'C',1);
        $this->Cell(20,10,'Status',1,1,'C',1);
    }

    // Rodapé da tabela
    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial','I',8);
        $this->Cell(0,10,'pagina '.$this->PageNo().'/{nb}',0,0,'C');
    }

    // Tabela de dados
    function ChapterBody($getDadoAbonosRelatorio)
    {
        $this->SetFont('Arial','',10);
        foreach($getDadoAbonosRelatorio as $dados)
        {
            if($dados['status'] == '1'){
                $status = 'Pendente';
            } elseif($dados['status'] == '2'){
                $status = 'Aprovado';
            } else{
                $status = 'Reprovado';
            }
            

            $this->Cell(100,6,utf8_decode($dados['nome']),1,0);
            $this->Cell(20,6,$dados['batida1'],1,0);
            $this->Cell(20,6,$dados['batida2'],1,0);
            $this->Cell(20,6,$dados['batida3'],1,0);
            $this->Cell(20,6,$dados['batida4'],1,0);
            $this->Cell(20,6,$dados['batida5'],1,0);
            $this->Cell(20,6,$dados['batida6'],1,0);
            #$this->Cell(40,6,utf8_decode($dados['justificativa']),1,0);
            $this->Cell(30,6,date('d/m/Y', strtotime($dados['dia'])),1,0);
            $this->Cell(20,6,$status,1,1);
        }
    }
}

$pdf = new PDF('L');
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','',12);


$pdf->ChapterBody($getDadoAbonosRelatorio);

$nomeArquivo = 'relatorio_abonos_' . date('d/m/Y');

$pdf->Output('I', $nomeArquivo);
?>
