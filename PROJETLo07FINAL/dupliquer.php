<?php
$BDD = new PDO('mysql:host=localhost;dbname=projet lo07', 'root','', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
$reponse=$BDD->prepare("
CREATE TEMPORARY TABLE tmp SELECT * FROM appratient WHERE id = ?;

UPDATE tmp SET id= WHERE id = 99;

INSERT INTO appartient SELECT * FROM tmp WHERE id = 100;

	")






?>