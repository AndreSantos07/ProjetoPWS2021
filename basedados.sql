CREATE DATABASE rar_aeroportos;
USE rar_aeroportos;

CREATE TABLE users (
user_id int UNSIGNED AUTO_INCREMENT,
name varchar(30) NOT NULL,
road varchar(50) NOT NULL,
location varchar(50) NOT NULL,
postalcode varchar(10) NOT NULL,
birthdate varchar(50) NOT NULL,
email varchar(30) NOT NULL,
nif varchar(9) UNIQUE NOT NULL,
phone int(9) NOT NULL,
username varchar(30) NOT NULL,
pass varchar(30) NOT NULL,
profiletype varchar(20) NOT NULL,
CONSTRAINT pk_users_id PRIMARY KEY (user_id)
) engine=innoDB;

CREATE TABLE passengers (
passenger_id int UNSIGNED AUTO_INCREMENT,
checkin ENUM('Sim', 'Não'),
user_id int UNSIGNED NOT NULL,
CONSTRAINT pk_passengers_id PRIMARY KEY (passenger_id),
CONSTRAINT fk_passengers_utilizador_id FOREIGN KEY (user_id) REFERENCES rar_aeroportos.users (user_id)
) engine=innoDB;

CREATE TABLE airports (
airport_id int UNSIGNED AUTO_INCREMENT,
name varchar(50) NOT NULL,
location varchar(30) NOT NULL,
country varchar(30) NOT NULL,
CONSTRAINT pk_airports_id PRIMARY KEY (airport_id)
) engine=innoDB;

CREATE TABLE planes (
plane_id int UNSIGNED AUTO_INCREMENT,
name varchar(30) NOT NULL,
capacity int(3) NOT NULL,
type varchar(20) NOT NULL,
CONSTRAINT pk_planes_id PRIMARY KEY (plane_id)
) engine=innoDB;

CREATE TABLE scales (
scale_id int UNSIGNED AUTO_INCREMENT,
origin_id int UNSIGNED NOT NULL,
destiny_id int UNSIGNED NOT NULL,
distance decimal(7,2) NOT NULL,
departure varchar(50) NOT NULL,
arrival varchar(50) NOT NULL,
numbertickets int NOT NULL,
plane_id int UNSIGNED NOT NULL,
CONSTRAINT pk_scales_id PRIMARY KEY (scale_id),
CONSTRAINT fk_scales_origem_id FOREIGN KEY (origin_id) REFERENCES rar_aeroportos.airports (airport_id),
CONSTRAINT fk_scales_destino_id FOREIGN KEY (destiny_id) REFERENCES rar_aeroportos.airports (airport_id),
CONSTRAINT fk_scales_aviao_id FOREIGN KEY (plane_id) REFERENCES rar_aeroportos.planes (plane_id)
)  engine=innoDB;

CREATE TABLE flights (
flight_id int UNSIGNED AUTO_INCREMENT,
origin_id int UNSIGNED NOT NULL,
destiny_id int UNSIGNED NOT NULL,
price DECIMAL(6,2) NOT NULL,
departure varchar(50) NOT NULL,
arrival varchar(50) NOT NULL,
CONSTRAINT pk_flights_id PRIMARY KEY (flight_id),
CONSTRAINT fk_flights_origem_id FOREIGN KEY (origin_id) REFERENCES rar_aeroportos.airports (airport_id),
CONSTRAINT fk_flights_destino_id FOREIGN KEY (destiny_id) REFERENCES rar_aeroportos.airports(airport_id)
) engine=innoDB;

CREATE TABLE flights_scales (
id int UNSIGNED AUTO_INCREMENT,
scale_id int UNSIGNED NOT NULL,
flight_id int UNSIGNED NOT NULL,
ordering int NOT NULL,
CONSTRAINT pk_flights_scales_id PRIMARY KEY (id),
CONSTRAINT fk_flights_scales_escala_id FOREIGN KEY (scale_id) REFERENCES rar_aeroportos.scales (scale_id),
CONSTRAINT fk_flights_scales_voo_id FOREIGN KEY (flight_id) REFERENCES rar_aeroportos.flights (flight_id)
) engine=innoDB;

CREATE TABLE ticket_sales (
ticket_id int UNSIGNED AUTO_INCREMENT,
purchasedate varchar(50),
type ENUM('Ida','Ida e Volta') NOT NULL,
user_id int UNSIGNED NOT NULL,
CONSTRAINT pk_ticket_sales_id PRIMARY KEY (ticket_id),
CONSTRAINT pk_ticket_sales_user_id FOREIGN KEY (user_id) REFERENCES rar_aeroportos.users (user_id)
) engine=innoDB;

CREATE TABLE flights_ticket_sales (
id int UNSIGNED AUTO_INCREMENT,
ticket_id int UNSIGNED NOT NULL,
flight_id int UNSIGNED NOT NULL,
type ENUM('ida','volta'),
CONSTRAINT pk_flights_ticket_sales_id PRIMARY KEY (id),
CONSTRAINT pk_flights_ticket_sales_passagem_id FOREIGN KEY (ticket_id) REFERENCES rar_aeroportos.ticket_sales (ticket_id),
CONSTRAINT pk_flights_ticket_sales_voo_id FOREIGN KEY (flight_id) REFERENCES rar_aeroportos.flights (flight_id)
) engine=innoDB;

INSERT INTO `airports` (`airport_id`, `name`, `location`, `country`) VALUES (NULL, 'Aeroporto El Prat', 'Barcelona', 'Espanha'), (NULL, 'Aeroporto de Fiumicino', 'Roma', 'Italia');
INSERT INTO `airports` (`airport_id`, `name`, `location`, `country`) VALUES (NULL, 'Aeroporto de Barajas', 'Madrid', 'Espanha'), (NULL, 'Aeroporto de Heathrow', 'Londres ', 'Reino Unido');
INSERT INTO `airports` (`airport_id`, `name`, `location`, `country`) VALUES (NULL, 'Aeroporto de Malpensa', 'Milao', 'Italia'), (NULL, 'Aeroporto Francisco Sá Carneiro', 'Porto', 'Portugal');

INSERT INTO `planes` (`plane_id`, `name`, `capacity`, `type`) VALUES (NULL, 'AVRO RJ100', '130', 'Regional'), (NULL, 'AIRBUS A320', '189', 'Corredor Unico');
INSERT INTO `planes` (`plane_id`, `name`, `capacity`, `type`) VALUES (NULL, 'B767-300', '351', 'Dois Corredores'), (NULL, 'B767-200', '290', 'Dois Corredores');

INSERT INTO `flights` (`flight_id`, `origin_id`, `destiny_id`, `price`, `departure`, `arrival`) VALUES (NULL, '2', '1', '150.00', '2021-05-27 11:30:00', '2021-05-27 16:30:00');
INSERT INTO `flights` (`flight_id`, `origin_id`, `destiny_id`, `price`, `departure`, `arrival`) VALUES (NULL, '5', '6', '120.00', '2021-06-15 10:40:38', '2021-06-16 03:20:00');
INSERT INTO `flights` (`flight_id`, `origin_id`, `destiny_id`, `price`, `departure`, `arrival`) VALUES (NULL, '3', '2', '200.00', '2021-06-10 16:10:00', '2021-06-10 23:50:00');
INSERT INTO `flights` (`flight_id`, `origin_id`, `destiny_id`, `price`, `departure`, `arrival`) VALUES (NULL, '2', '1', '120.00', '2021-06-03 08:25:43', '2021-06-03 21:39:00');
