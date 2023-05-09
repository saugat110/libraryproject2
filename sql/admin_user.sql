use Project1;

-- student part

create table student(
	s_id int not null auto_increment,
	roll varchar(4) not null, 
	fname varchar(30) not null,
	lname varchar(30) not null,
	email varchar(50) not null,
	phone varchar(10) not null,
	faculty enum('BCA', 'BBS', 'BSW', 'MBS') not null,
	address varchar(30) not null,
	password varchar(30) not null default 'reliance',
	pcode varchar(5) NOT  NULL DEFAULT '-----',
	fine int not null default 0,
	constraint primary key (s_id)
);


alter table student 
	add column password varchar(30) not null default 'reliance'
after  address;




-- admin part

create table admin(
	a_id int not null auto_increment,
	fname varchar(30) not null,
	lname varchar(30) not null,
	email varchar(50) not null,
	phone varchar(10) not null,
	address varchar(30) not null,
	password varchar(30) not null default 'reliance',
	pcode varchar(5) not null default '-----',
	role enum ('admin', 'superadmin') not null default 'admin',
	constraint primary key(a_id)
);




alter table student 
	add column pcode varchar(5) default '-----'
	after password;

alter table admin 
	add column pcode varchar(5) default ''
	after password;

drop table admin;
drop table student;

select * from student;
select * from admin;

desc student;


































