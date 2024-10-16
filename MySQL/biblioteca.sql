drop database if exists biblioteca;
create database biblioteca;
use biblioteca;

create table socios(
id int auto_increment primary key,
nombre varchar(100) not null,
fechaSancion date default null,
email varchar(255) not null
)engine innodb;
insert into socios values (null,'Alejandro Salguero', null, 'alejandor@gmail.com'),
(null,'Paco Pepe', null, 'pacopepe@gmail.com'),
(null,'Pazo Quevedo ', null, 'pazoquevedo@gmail.com'),
(null,'Kuko Gafas', null, 'kukogafas@gmail.com'),
(null,'Pedro Porro', null, 'pedroporro@gmail.com');

create table libros(
id int auto_increment primary key,
titulo varchar(100) not null,
ejemplares int not null,
autor varchar(100)
)engine innodb;
insert into libros values (null,'harry potter',0,'Alejandro Dwan'),
(null,'El niño del pijama de rayas',12,'Fran Sayago'),
(null,'Terra Alta',4,'Hernesto Sevilla');

create table prestamos(
id int auto_increment primary key,
libros int not null,
socio int not null,
fechaP date not null, -- Fecha Presastamo
fechaD date not null, -- fecha Devolucion
fechaRD date null default null, -- Fecha real Devolucion
foreign key (socio) references socios(id) on update cascade on delete restrict,
foreign key (socio) references socios(id) on update cascade on delete restrict
)engine innodb;

insert into prestamos value (null,1,1,20230101,20230115,null),
(null,2,1,20230101,20230115,20230110),
(null,2,3,20240901,20241031,null),
(null,2,1,20240901,20241031,null),
(null,3,3,20240901,20241031,null);;

-- Funcion que com prueba sis se puede prestar el libro al socio
-- Devuleve :
-- 1 Si se puede hacer el prestamo
-- -1 Si se hay ejemplares ddel libro
-- -2 Si esta sancionado
-- -3 si el socio tiene prestamos caducados
-- -4 Si el socio tiene mas de 2 libros prestados
-- 0 Cualquier otro caso (error)
delimiter //
create function comprobarSiPrestar(pSocio int, pLibro int) returns int deterministic
begin
declare resultado int default 1;
declare vId int;
-- comprobar ejemplares
select id into vId from libros

 where id=pLibro and ejemplares>0;
 if(vId is null) then
 return -1;
 end if;
 
 -- comprobar Socio
 select id into vId from socios

 where id=pSocio and fehcaSancion is null;
 if(vId is null) then
 return -2;
 end if;
 
  -- comprobar si tiene prestamos caducados
 select count(*) into vId from prestamos
 where socio=pSocio and fechadevolucion < curdate() and  fechaRD is null ;
 if(vId > 0) then
 return -3;
 end if;
 
 -- comprobar si tiene mas de 2 libros
  select count(*) into vId from prestamos
 where socio=pSocio and fechadevolucion > curdate() and  fechaRD is null ;
 if(vId > 2) then
 return -4;
 end if;
 
 -- Chequear si el socio tiene 2 o más libros
 select count(*) into vId from prestamos
	where socio = pSocio and fechaRD is null;
	if(vId >=2) then
 return -4;
end if;

return resultado;
end//
delimiter ;

select comprobarSiprestar(5,1); -- Chequea ejemplares
select comprobarSiprestar(50,2); -- Chequea libro existe
select comprobarSiprestar(5,2); -- Chequea socio
select comprobarSiprestar(1,2); -- Chequea socio 
select comprobarSiprestar(2,2); 
select comprobarSiprestar(3,2);
select comprobarSiprestar(4,2);