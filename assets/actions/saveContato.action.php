<?php
include '../classes/Contato.class.php';
include '../classes/ContatoDAO.class.php';

$contato = new Contato();

$contato->setId($_POST['id']);
$contato->setNome($_POST['nome']);
$contato->setEmail($_POST['email']);
$contato->setEndereco($_POST['endereco']);
$contato->setTelefone($_POST['telefone']);

$dao = new ContatoDAO();
$result = false;

if(empty($_POST['id'])) {
	$result = $dao->insert($contato);
}
else {
	$result = $dao->update($contato);
}

if($result) {
	//header é um método nativo para realizar redirencioamentos ou 
	//configurações de cabeçalhos
	header("Location: ../index.html?success=true"); //OLHAR ISSO AQUI   MAIN.PHP????
}
else {
	header("Location: ../formCadastro.html?fail=true"); //OLHAR ISSO AQUI   FORMCONTATO.PHP????
}

?>
