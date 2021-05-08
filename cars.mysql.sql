DROP DATABASE IF EXISTS cars;

CREATE DATABASE cars;
USE cars;

CREATE TABLE subsidiary (
	company_name CHARACTER VARYING(20),	
	year INTEGER NOT NULL,
	type CHARACTER VARYING(15) NOT NULL,

	PRIMARY KEY (company_name)
);

CREATE TABLE automobile (
	model CHARACTER VARYING(10),
	price integer not null,
	horsepower integer not null,
	transmission character(1) not null,
	torque integer not null, 
	weight integer not null, 
	engine character varying (10) not null,
	drive_type character(1) not null, 
	subsidiary character varying(20),
	mpg integer not null, 
	
	primary key (model),
	foreign key (subsidiary) references subsidiary (company_name)
		on update cascade on delete restrict
);

CREATE TABLE sedan (
	model character varying(10),
	numberDoors integer not null,
	occupancy integer not null,
	trunkSize integer not null,
	primary key(model),
	foreign key (model) references automobile (model)
		on update cascade on delete restrict
);

CREATE TABLE compact (
	model character varying(10),
	occupancy integer not null,
	type character varying(15) not null, 

	primary key(model),
	foreign key (model) references automobile (model)
		on update cascade on delete restrict
);

CREATE TABLE suv(
	model character varying(10),
	rideHeight integer not null, 
	towCapacity integer not null,

	primary key(model),
	foreign key (model) references automobile (model)
		on update cascade on delete restrict
);

CREATE TABLE wagon(
	model character varying(10),
	interiorSpace integer not null,
	occupancy integer not null,

	primary key(model),
	foreign key (model) references automobile (model)
		on update cascade on delete restrict
);

create table country(
	name character varying(10),
	side character varying(10),
	
	primary key(name)
);

create table sold(
	model character varying(10),
	country character varying(10),
	
	primary key(model, country),
	foreign key(model) references automobile (model)
		on update cascade on delete restrict,
	foreign key(country) references country (name)
		on update cascade on delete restrict
);

insert into subsidiary (company_name, year, type) values
('Volkswagen', 1937, 'commercial'),
('Audi', 1932, 'luxury'),
('Bentley', 1919, 'luxury'),
('Bugatti', 1909, 'luxury'),
('Lamborghini', 1963, 'sports'),
('Porshe', 1948, 'sports');

insert into automobile (model, price, horsepower, transmission, torque, weight, engine, drive_type, subsidiary, mpg) values 
('golf', 23195, 147, 'm', 184, 2945, 'TSI', 'F', 'Volkswagen', 29),
('jetta', 18995, 147, 'm', 184, 2895, 'TSI', 'F', 'Volkswagen', 30),
('tiguan', 25245, 184, 'a', 221, 3735, 'TSI', 'F', 'Volkswagen', 23),
('passat', 23995, 174, 'a', 206, 3314, 'TSI', 'F', 'Volkswagen', 24),
('Q5', 43300, 261, 'a', 369, 4079, 'TFSI', 'A', 'Audi', 23),
('A3', 33300, 184, 'a', 221, 3197, 'TSI', 'A', 'Audi', 27),
('A6', 54900, 261, 'a', 273, 4101, 'TFSI', 'A', 'Audi', 23),
('R8', 142700, 532, 'a', 398, 3595, 'V8FSI', 'A', 'Audi', 14),
('RS6', 109000, 591, 'a', 590, 5960, 'V8TFSI', 'A', 'Audi', 15),
('Cont GT', 206600, 542, 'a', 664, 5181, 'GTC', 'A', 'Bentley', 12),
('Bentayga', 177000, 542, 'a', 568, 5379, 'W12', 'A', 'Bentley', 14),
('Mulsanne', 310800, 512, 'a', 811, 5850, 'W12', 'A', 'Bentley', 14),
('Chiron', 2990000, 1500, 'a', 1180, 4504, 'W16', 'A', 'Bugatti', 9),
('Veyron', 1900000, 987, 'a', 1100, 4147, 'W16', 'A', 'Bugatti', 11),
('Urus', 207326, 641, 'a', 625, 4850, 'V8', 'A', 'Lamborghini', 12),
('Huracan', 208571, 630, 'a', 413, 3424, 'V10', 'A', 'Lamborghini', 13),
('Aventador', 417826, 740, 'a', 663, 4085, 'V12', 'A', 'Lamborghini', 9),
('Cayenne', 67500, 335, 'a', 406, 4398, 'Hybrid', 'A', 'Porshe', 45),
('Macan', 52100, 248, 'a', 284, 4099, 'V6', 'A', 'Porshe', 19),
('911', 99200, 379, 'a', 264, 3142, 'Boxer', 'A', 'Porshe', 20),
('718', 59900, 300, 'a', 248, 3075, 'Boxer', 'A', 'Porshe', 16);

insert into sedan (model, numberDoors, occupancy, trunkSize) values
('jetta', 4, 4, 14),
('passat', 4, 4, 16),
('A3', 4,4, 12),
('A6',4,4,14),
('R8',2,2,4),
('Cont GT',2,4,9),
('Mulsanne',4,4,9),
('Chiron',2,2,2),
('Veyron',2,2,2),
('Huracan',2,2,4),
('Aventador',2,2,4);

insert into compact (model, occupancy, type) values 
('golf',4,'hatchback'),
('911',2,'roadster'),
('718',2,'roadster');

insert into suv (model, rideHeight, towCapacity) values
('tiguan', 8, 1500),
('Q5', 8, 4400),
('Bentayga', 6, 7700),
('Urus',6,7700),
('Cayenne',4,7700),
('Macan',7,4400);

insert into wagon (model, interiorSpace, occupancy) values
('RS6', 64, 4);

insert into country (name, side) values
('America', 'right'),
('Japan', 'left'),
('Britain', 'left');

insert into sold
select model, name
from automobile cross join country;

 




 







