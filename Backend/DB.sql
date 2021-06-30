create database fastParking;

use fastParking;

create table tblCarros (
	idCarro int primary key not null auto_increment,
    nome varchar(45) not null,
    laca varchar(8) not null,
    dataEntrada date not null,
    horaEntrada time not null,
    horaSaida time,
	valorPago decimal,
    unique key (idCarro)
);

create table tblPrecos (
	idPreco int primary key not null auto_increment,
    primeiraHora int not null,
    demaisHoras int not null,
	dataHora datetime,
    idCarro int not null,
    unique key (idPreco),
    constraint FK_Carros_Precos
    foreign key (idCarro)
    references tblCarros (idCarro)
);
        
insert into tblCarros (nome, dataEntrada, horaEntrada, valorPago, placa) 
	values ('Maria Silva', '2021-06-28', '11:32:00', 0.0, 'KKK-3132');
    

insert into tblPrecos (dataHora, idCarro, primeiraHora, demaisHoras) 
	values ('2021-06-28 11:39:00', 2, 2, 5);

select * from tblPrecos;

