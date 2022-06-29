<?php
    session_start();
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "cashflow2";
    $licznik_kont_kredytowych = 0;
    $conn = new mysqli($servername, $username, $password, $dbname);
    if (!isset($_SESSION['zalogowany']))
	{
		header('Location: index.php');
		exit();
	}
?>