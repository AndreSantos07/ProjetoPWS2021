CREATE DATABASE teste;
USE teste;

CREATE TABLE utilizadores (
idutilizador int UNSIGNED AUTO_INCREMENT,
nome varchar(30) NOT NULL,
rua varchar(50) NOT NULL,
localidade varchar(50) NOT NULL,
codigo_postal varchar(10) NOT NULL,
datanasc datetime NOT NULL,
email varchar(30) NOT NULL,
NIF varchar(9) UNIQUE NOT NULL,
telefone int(9) NOT NULL,
username varchar(30) NOT NULL,
pass varchar(30) NOT NULL,
tipoperfil varchar(20) NOT NULL,
CONSTRAINT pk_utilizadores_id PRIMARY KEY (idutilizador)
) engine=innoDB;

CREATE TABLE passageiros (
idpassageiro int UNSIGNED AUTO_INCREMENT,
checkin ENUM('Sim', 'Não'),
idutilizador int UNSIGNED NOT NULL,
CONSTRAINT pk_passageiros_id PRIMARY KEY (idpassageiro),
CONSTRAINT fk_passageiros_idutilizador FOREIGN KEY (idutilizador) REFERENCES rar_aeroportos.utilizadores (idutilizador)
) engine=innoDB;

CREATE TABLE aeroportos (
idaeroporto int UNSIGNED AUTO_INCREMENT,
nome varchar(30) NOT NULL,
localizacao varchar(30) NOT NULL,
CONSTRAINT pk_aeroportos_id PRIMARY KEY (idaeroporto)
) engine=innoDB;

CREATE TABLE avioes (
idaviao int UNSIGNED AUTO_INCREMENT,
nome varchar(30) NOT NULL,
lotacao int(3) NOT NULL,
tipo varchar(20) NOT NULL,
CONSTRAINT pk_avioes_id PRIMARY KEY (idaviao)
) engine=innoDB;

CREATE TABLE escalas (
idescala int UNSIGNED AUTO_INCREMENT,
idaeroportoorigem int UNSIGNED NOT NULL,
idaeroportodestino int UNSIGNED NOT NULL,
distancia decimal(7,2) NOT NULL,
CONSTRAINT pk_escalas_id PRIMARY KEY (idescala),
CONSTRAINT fk_escalas_idaeroportoorigem FOREIGN KEY (idaeroportoorigem) REFERENCES rar_aeroportos.aeroportos (idaeroporto),
CONSTRAINT fk_escalas_idaeroportodestino FOREIGN KEY (idaeroportodestino) REFERENCES rar_aeroportos.aeroportos (idaeroporto)
)  engine=innoDB;

CREATE TABLE voos (
idvoo int UNSIGNED AUTO_INCREMENT,
idaeroportoorigem int UNSIGNED NOT NULL,
idaeroportodestino int UNSIGNED NOT NULL,
preco DECIMAL(4,2) NOT NULL,
idaviao int UNSIGNED NOT NULL,
CONSTRAINT pk_voos_id PRIMARY KEY (idvoo),
CONSTRAINT fk_voos_idaeroportoorigem FOREIGN KEY (idaeroportoorigem) REFERENCES rar_aeroportos.aeroportos (idaeroporto),
CONSTRAINT fk_voos_idaeroportodestino FOREIGN KEY (idaeroportodestino) REFERENCES rar_aeroportos.aeroportos (idaeroporto),
CONSTRAINT fk_escalas_idaviao FOREIGN KEY (idaviao) REFERENCES rar_aeroportos.avioes (idaviao)
) engine=innoDB;

CREATE TABLE voos_escalas (
idescala int UNSIGNED NOT NULL,
idvoo int UNSIGNED NOT NULL,
CONSTRAINT fk_voos_escalas_idescala FOREIGN KEY (idescala) REFERENCES rar_aeroportos.escalas (idescala),
CONSTRAINT fk_voos_escalas_idvoo FOREIGN KEY (idvoo) REFERENCES rar_aeroportos.voos (idvoo)
) engine=innoDB;

CREATE TABLE passagemvenda (
idpassagem int UNSIGNED AUTO_INCREMENT,
datacompra datetime,
tipo ENUM('Ida','Ida e Volta') NOT NULL,
idvoo int UNSIGNED NOT NULL,
CONSTRAINT pk_passagemvenda_id PRIMARY KEY (idpassagem),
CONSTRAINT fk_passagemvenda_idvoo FOREIGN KEY (idvoo) REFERENCES rar_aeroportos.voos (idvoo)
) engine=innoDB;