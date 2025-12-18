<?php
$pdo = new PDO('mysql:host=localhost;port=3306;dbname=misc', 'fred', 'zap');
// Pour voir les erreurs PDO comme des exceptions
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>
