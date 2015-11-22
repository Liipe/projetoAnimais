<?php
/*
 * Transfer Object
 * Classe contendo os dados do contato
 * 
 */
class Contato {
	
	private $id;
	private $nome;
	private $email;
    private $endereco;
	private $telefone;
	
	public function setId($id) {
		$this->id = $id;
	}
	public function getId() {
		return $this->id;
	}
	
	public function setNome($nome) {
		$this->nome = $nome;
	}
	public function getNome() {
		return $this->nome;
	}
	
	public function setEmail($email) {
		$this->email = $email;
	}
	public function getEmail() {
		return $this->email;
	}
    
    public function setEndereco($endereco) {
		$this->endereco = $endereco;
	}
	public function getEndereco() {
		return $this->endereco;
	}
	
	public function setTelefone($telefone) {
		$this->telefone = $telefone;
	}
	public function getTelefone() {
		return $this->telefone;
	}

}
?>
