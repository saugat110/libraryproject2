create table category(
	category_id int not null  auto_increment,
	Name varchar(30) not null,
	constraint primary key(category_id)
);

desc category;
select * from category;



create table author(
	auth_id int not null auto_increment,
	Name varchar(30) not null,
	constraint primary key(auth_id)
);

desc author;

select * from author;



create table rack(
	rack_id int not null auto_increment,
	Name varchar(30) not null,
	constraint primary key(rack_id)
);


desc rack;

select * from rack;