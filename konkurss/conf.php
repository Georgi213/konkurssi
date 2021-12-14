<?php
$serverinimi='localhost';
$kasutajanimi='georgiblinov';
$parool='123456';
$andmebaasinimi='blinov';
$yhendus=new mysqli($serverinimi, $kasutajanimi, $parool, $andmebaasinimi);
$yhendus->set_charset("UTF-8");
/*
CREATE TABLE loomad(id int primary key AUTO_INCREMENT,
nimi varchar(50),
kirjeldus text);
insert INTO loomad(nimi, kirjeldus)
VALUES ('Zebra','Polosatoe zivotnoe');

SELECT * FROM loomad
CREATE TABLE konkurss(
    id int PRIMARY KEY AUTO_INCREMENT,
    nimi varchar(50),
    pilt text,
    lisamiseaeg datetime,
    punktrid int DEFAULT 0,
    kommentaar text DEFAULT ' ',
    avalik int DEFAULT 1)*/
?>
