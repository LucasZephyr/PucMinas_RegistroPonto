<?php

session_start();

// ini_set('display_errors',1);
// ini_set('display_startup_erros',1);
// error_reporting(E_ALL);


include '../../assets/PHPMailer/class.phpmailer.php';
include '../../assets/PHPMailer/class.smtp.php';

include '../../classes/sql.class.php';
$sql = new SQL();

$verificaDadosLogin = $sql->verificaDadosEsqueciSenha($_REQUEST); 


$arrayResposta = array();
if(empty($verificaDadosLogin)){
	$arrayResposta = array('informacao' => 'Error', 'message' => 'Dados Incorreto!');
	echo json_encode($arrayResposta);exit;

}

#	echo "<pre>";print_r($verificaDadosLogin);exit;

$email = 'seu email com dominio';
$password = 'sua senha';

    

$novaSenha = gerarSenha();

$mail = new PHPMailer();
$mail->IsSMTP();
$mail->CharSet = 'UTF-8';
#$mail->SMTPDebug = 1;
$mail->SMTPAuth = true;
$mail->SMTPSecure = 'ssl';
$mail->Host = "smtp.gmail.com";
$mail->Port = "465";
$mail->Username  = $email;
$mail->Password  = $password;
$mail->From = $email;
$mail->FromName = "Gestao Ponto Eletronico";
$mail->IsHTML(true);

$mail->AddAddress($verificaDadosLogin[0]['email'],$verificaDadosLogin[0]['nome']);


$mail->Subject = "PROTOCOLO DE ALTERAÇÃO DE SENHA - GESTAO";


$conteudo = '
Caro '. $verificaDadosLogin[0]['nome'] .' ,<br>
Recebemos uma solicitação de alteração da sua senha.

<br>
<br>

Sua senha foi alterada para <b style="font-size: 18px">'.$novaSenha.'</b>

<br>
<br>

Por favor, acesso o menu de "Redefinir Senha" no sistema e altere para uma senha pessal. Agradecemos o contato.
';
$mail->Body = $conteudo;


if(!$mail->Send()){
  #echo "Erro ao enviar e-mail" . $mail->ErrorInfo;
	$arrayResposta = array('informacao' => 'error', 'message' => "Falha ao enviar Email - Protocolo cancelado!");
	echo json_encode($arrayResposta);exit;

}else{
	$alterarSenha = $sql->alterarSenhaEsqueciSenha($verificaDadosLogin[0]['id_usuario'], $novaSenha);

	if($alterarSenha['informacao'] == 'SUCESSO'){
		$arrayResposta = array('informacao' => 'SUCESSO', 'message' => 'Senha Enviada! ' . "\n" . "Verifique seu Email");
		echo json_encode($arrayResposta);exit;
	}else{
		$arrayResposta = array('informacao' => 'error', 'message' => "Senha não alterada!");
		echo json_encode($arrayResposta);exit;
	}
}








function gerarSenha() {
    $caracteresMaiusculos = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $caracteresMinusculos = 'abcdefghijklmnopqrstuvwxyz';
    $digitos = '0123456789';

    $senha = $caracteresMaiusculos[rand(0, strlen($caracteresMaiusculos) - 1)];

    $senha .= $caracteresMinusculos[rand(0, strlen($caracteresMinusculos) - 1)];

    for ($i = 0; $i < 12; $i++) {
        $senha .= $digitos[rand(0, strlen($digitos) - 1)];
    }
    $senha = str_shuffle($senha);
    return $senha;
}







