<?php
//PDO konstruktor prima 3 parametra:
//1: koja je baza:ime baze;gdje se baza nalazi (127.0.0.1 = localhost)
//2: korisnik na bazi
//3: lozinka 
$pdo=new PDO("mysql:dbname=" . $imeBaze . ";host=" . $adresaServera,$korisnikBaza,$lozinkaBaza);
$pdo->exec("SET CHARACTER SET utf8");
$pdo->exec("SET NAMES utf8");
