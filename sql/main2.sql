create table admin(
	a_id int not null auto_increment,
	fname varchar(30) not null,
	lname varchar(30) not null,
	email varchar(50) not null,
	phone varchar(10) not null,
	address varchar(30) not null,
	password varchar(30) not null default 'radmin',
	pcode varchar(5) not null default '-----',
	role enum ('admin', 'superadmin') not null default 'admin',
	constraint primary key(a_id)
);

create table student(
	s_id int not null auto_increment,
	roll varchar(4) not null unique, 
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

create table category(
	category_id int not null  auto_increment,
	Name varchar(30) not null unique,
	constraint primary key(category_id)
);

create table author(
	auth_id int not null auto_increment,
	Name varchar(30) not null unique,
	constraint primary key(auth_id)
);

create table rack(
	rack_id int not null auto_increment,
	Name varchar(30) not null unique,
	constraint primary key(rack_id)
);

create table books(
	b_id int not null auto_increment,
	name varchar(50) not null,
	isbn varchar(30) not null,
	author varchar(30) not null,
	category varchar(50) not null,
	rack varchar(10) not null,
	copies int not null,
	imgname varchar(30) default '',
	constraint primary key (b_id),
    foreign key (author) references author(Name),
    foreign key (category) references category (Name),
    foreign key (rack) references rack (Name)
);

create table issue_book(
	issue_id int not null auto_increment,
	Book varchar(70) not null,
	Student varchar(50) not null,
    Roll varchar(4) not null,
	Issue_date varchar(10) not null,
	Expected_return varchar(10) not null,
	Returned_date varchar(10) default '----------' not null,
 	Status enum('Issued', 'Returned', 'Not returned'),
	constraint primary key(issue_id),
    foreign key (Roll) references student(roll)
);