create database if not exists `bacon`;
use `bacon`;

CREATE TABLE users (
id INT(32) NOT NULL auto_increment,
user VARCHAR(64),
first_name VARCHAR(64),
last_name VARCHAR(64),
password VARCHAR(128),
primary KEY (id));

insert into users (id, user, first_name, last_name, password) values
(1, 'admin', 'Joe', 'Baconz', md5('password')),
(2, 'notadmin', 'Homer', 'Simpson', md5('bacon'));



CREATE TABLE products (
id INT(32) NOT NULL auto_increment,
title VARCHAR(64),
description TEXT,
price INT(12),
primary KEY (id));

insert into products (id, title, description, price) values
(1, 'Rindless Shortcut Bacon 250g', 'om nom nom nom', 1200),
(2, 'Middle Bacon 200g', 'Bacon all the yummy things!', 1400),
(3, 'All the bacons', 'More bacon than you can possibly imagine!', 1400)
;