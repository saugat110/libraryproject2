use  Project1;

select database();

create table books(
	b_id int not null auto_increment,
	name varchar(50) not null,
	isbn varchar(30) not null,
	author varchar(30) not null,
	category varchar(50) not null,
	rack varchar(10) not null,
	copies int not null,
	imgname varchar(30) default '',
	constraint primary key (b_id)
);

desc books;

select * from books;

drop table books;