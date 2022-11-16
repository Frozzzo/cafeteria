create database cafeteria

use cafeteria

create table productos
(
ID int AUTO_INCREMENT not null primary key,
nombre varchar(100) not null,
referencia varchar(255),
precio decimal not null,
peso int not null,
categoria enum('ALIMENTOS', 'BEBIDAS', 'CHARCUTERIA') default 'ALIMENTOS',
stock int not null,
fecha_creacion timestamp default current_timestamp,
eliminar boolean not null default false
)
