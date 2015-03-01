drop database if exists osc_snoit;
create database osc_snoit charset utf8 collate utf8_general_ci;
use osc_snoit;

create table zapis(
	sifra 		int 			not null 	primary key 	auto_increment,
	tko 		nvarchar(255) 	not null,
	odkuda 		nvarchar(255) 	not null,
	kada 		datetime 		not null,
	prvibroj 	nvarchar(255) 	not null,
	drugibroj 	nvarchar(255) 	not null
)engine=innodb;

