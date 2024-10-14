drop database if exists bibilioteca;
create database bibilioteca;
use biblioteca;

create table socios(
id int auto_increment primary key,
nombre varchar(100) not null,
fechaSancion date default null,
email varchar(255) not null
)engine innodb;

create table librosj(

id int auto_increment primary key,
titulo varchar(100) not null,
ejemplares int not null,
autor varchar(100)
)engine innodb;

create table prestamos(
id int auto_increment primary key,
socio int not null,
libro int not null,
fechaP date not null, -- Fecha préstamo
fechaRD date not null,-- Fecha Devolución
foreign key (socio) references socio(id) on update cascade on delete restrict,
foreign key (libro) references libros(id) on update cascade on delete restrict
)engine innodb;

delimiter //
create function comprobarSiPrestar(pSocio int,pLibro int) returns int 
begin

end;
delimiter ;