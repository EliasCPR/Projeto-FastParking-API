create database fastParking;

use fastParking;

create table tblCarros (
	idCarro int primary key not null auto_increment,
    nome varchar(45) not null,
    dataEntrada date not null,
    horaEntrada time not null,
    horaSaida time not null,
	valorPago decimal,
    unique key (idCarro)
);

create table tblPrecos (
	idPreco int primary key not null auto_increment,
    primeiraHora time not null,
    demaisHoras time not null,
	dataHora datetime,
    idCarro int not null,
    unique key (idPreco),
    constraint FK_Carros_Precos
    foreign key (idCarro)
    references tblCarros (idCarro)
);

select * from tblPrecos;

alter table tblCarros
	add column placa varchar(8) not null;