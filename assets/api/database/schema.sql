CREATE TABLE users (
  id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  name VARCHAR(50) NOT NULL,
  email VARCHAR(100) NOT NULL,
  telefone VARCHAR(11) NOT NULL,    
  rua VARCHAR(250) NOT NULL,
  bairro VARCHAR(100) NOT NULL,
  numero INT NOT NULL,
  cidade VARCHAR(150)NOT NULL,    
  
  PRIMARY KEY (id)
)
ENGINE=InnoDB;

INSERT INTO users (id, name, email,telefone, rua, bairro, numero, cidade) VALUES 
    (1, 'Júlio Cezar', 'ocjulio@outlook.com', '9 9999-9999', 'Rua dos Cravos', 'Jardim Iara', 291, 'Pouso Alegre'),
    (2, 'Luiz Felipe', 'liipe@gmail.com', '9 9999-9999', 'Rua das Papoulas', 'Jardim Iara', 290, 'Pouso Alegre');
