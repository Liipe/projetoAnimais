<?php

class ContatoDAO {
	
	private $pdo; // PDO = PHP Data Object
	private $contatos = array(); // Lista de Contatos
	
	/**
	 * Construtor da classe ContatoDAO
	 */
	public function __construct() {
		//PDO = PHP Data Object, equivalente ao JDBC do java
		$this->pdo = new PDO("mysql:host=localhost;dbname=contato", "root", "");
	}
	
	/**
	 * Método para realizar o cadastro de um contato
	 */
	public function insert(Contato $contato) {
		$pdo  = $this->pdo;
		
		$stmt = $pdo->prepare('
			INSERT INTO contato (nome, email, endereco, telefone) 
			VALUES (?, ?, ?, ?)
		');
		
		$stmt->bindParam(1, $contato->getNome());
		$stmt->bindParam(2, $contato->getEmail());
        $stmt->bindParam(4, $contato->getEndereco());
		$stmt->bindParam(3, $contato->getTelefone());
		
		if($stmt->execute()) {
			return true;
		}
		
		return false;
	}
	
	/**
	 * Método para atualizar os dados de um contato
	 */
	public function update(Contato $contato) {
		$pdo  = $this->pdo;
		
		$stmt = $pdo->prepare('
			UPDATE contato SET 
				nome = ?,
				email = ?,
                endereco = ?,
				telefone = ?,
			WHERE id = ?
		');
		
		$stmt->bindParam(1, $contato->getNome());
		$stmt->bindParam(2, $contato->getEmail());
        $stmt->bindParam(3, $contato->getEndereco());
		$stmt->bindParam(4, $contato->getTelefone());
		$stmt->bindParam(5, $contato->getId());
		
		if($stmt->execute()) {
			return true;
		}
		
		return false;
	}
	
	/**
	 * Método para remover um contato do banco
	 */
	public function delete($id) {
		$id = (int) $id;
		if(!empty($id) && is_integer($id)) {
			$pdo  = $this->pdo;
			$stmt = $pdo->prepare('DELETE FROM contato WHERE id = ?');
			$stmt->bindParam(1, $id);
			if($stmt->execute()) {
				return true;
			}
		}
		return false;
	}
	
	/**
	 * Retorna um contato pelo ID
	 */
	public function getById($id) {
		$id = (int) $id;
		if(!empty($id) && is_integer($id)) {
			$pdo  = $this->pdo;
			
			$stmt = $pdo->prepare('
				SELECT
					id, nome, email, endereco, telefone
				FROM
					contato
				WHERE
					id = ? 
			');
			
			$stmt->bindParam(1, $id);
			
			if($stmt->execute()) {
				$row = $stmt->fetch();
				$contato = $this->row2contatoTO($row);
				return $contato;
			}
		}
		return false;
	}
	
	/**
 	 * Retorna uma lista de contatos
	 */
	public function getAll(Contato $filtro) {
		$pdo  = $this->pdo;
		
		$stmt = $pdo->prepare('
			SELECT
				id, nome, email, endereco, telefone
			FROM
				contato
		');
		
		if($stmt->execute()) {
			while($row = $stmt->fetch()) {
				$this->contatos[] = $this->row2contatoTO($row);
			}
			return $this->contatos;
		}
		
		return NULL;
	}
	
	
	/**
	 * Cria um objeto Contato a partir do resultset
	 */
	private function row2contatoTO($row) {
		$contato = new Contato();
		
		$contato->setId($row['id']);
		$contato->setNome($row['nome']);
		$contato->setEmail($row['email']);
        $contato->setEndereco($row['endereco']);
		$contato->setTelefone($row['telefone']);
		
		return $contato;
	}
}
?>
