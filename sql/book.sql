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


desc admin;

alter table admin 
modify column password varchar(30) not null default 'radmin';

select * from student;
desc student;




create table issue_book(
	issue_id int not null auto_increment,
	Book varchar(70) not null,
	Student varchar(50) not null,
	Faculty enum ('BCA', 'BBS', 'BSW') not null,
	Issue_date varchar(10) not null,
	Expected_return varchar(10) not null,
 	Status enum('Issued', 'Returned', 'Not returned'),
	constraint primary key(issue_id)
);

create table issue_book(
	issue_id int not null auto_increment,
	Book varchar(70) not null,
	Student varchar(50) not null,
	Faculty enum ('BCA', 'BBS', 'BSW'),
	Issue_date varchar(10) not null,
	Expected_return varchar(10) not null,
	Returned_date varchar(10) default '----------' not null,
 	Status enum('Issued', 'Returned', 'Not returned'),
	constraint primary key(issue_id),
	foreign key (Book) 
);

desc issue_book;

select * from issue_book;

drop table issue_book;

desc student;

desc books;


DELIMITER //
CREATE TRIGGER update_status
BEFORE INSERT ON issue_book
FOR EACH ROW
BEGIN
    IF NEW.Expected_return < CURDATE() THEN
        SET NEW.Status = 'Not returned';
    END IF;
END;
//
DELIMITER ;

DELIMITER //
DROP TRIGGER IF EXISTS update_status;
//
DELIMITER ;


CREATE TABLE issue_book (
    issue_id INT NOT NULL AUTO_INCREMENT,
    Book VARCHAR(70) NOT NULL,
    ISBN varchar(30) not null,
    Student VARCHAR(50) NOT NULL,
    Faculty ENUM ('BCA', 'BBS', 'BSW') NOT NULL,
    Issue_date DATE NOT NULL,
    Expected_return DATE NOT NULL,
    Status ENUM('Issued', 'Returned', 'Not returned'),
    CONSTRAINT PRIMARY KEY (issue_id)
);

desc issue_book;



