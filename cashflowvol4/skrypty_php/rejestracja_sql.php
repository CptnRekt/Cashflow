<?php
if ( isset( $_POST['rejestruj'] ) ) {
    session_start();
    $email = @($_POST['email']);
    $login = @($_POST['login']);
    $haslo = @($_POST['haslo']);

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "cashflow2";
    $dopasowano = false;

    $conn = new mysqli( $servername, $username, $password, $dbname );

    if ( $conn->connect_error ) {
        die( "Błąd połączenia: " . $conn->connect_error );
    }

    $sql = 'INSERT INTO konta_uzytkownikow (login, haslo, email) values ("'.$login.'","'.$haslo.'","'.$email.'")';
    
    if ( $conn->query( $sql ) === TRUE ) {
        $ostatnie_id = $conn->insert_id;
        $sql = 'Insert into rodzaje_kont_kredytowych (nazwa, id_uzytkownika) values
        ("gotówka",'.$ostatnie_id.'),
        ("czek",'.$ostatnie_id.'),
        ("oszczędności",'.$ostatnie_id.'),
        ("karta kredytowa",'.$ostatnie_id.'),
        ("inwestycja",'.$ostatnie_id.'),
        ("pasywa finansowe",'.$ostatnie_id.')';
        $conn->query( $sql );
        $sql = 'Insert into kategorie_transakcji (nazwa, id_konta_uzytkownika) values
        ("Rodzina",'.$ostatnie_id.'),
        ("Transport",'.$ostatnie_id.'),
        ("Rachunki",'.$ostatnie_id.'),
        ("Opłaty oraz podatki",'.$ostatnie_id.'),
        ("Rozrywka",'.$ostatnie_id.'),
        ("Edukacja",'.$ostatnie_id.'),
        ("Dom",'.$ostatnie_id.'),
        ("Zdrowie",'.$ostatnie_id.')';
        $conn->query( $sql );
        $_SESSION["zarejestrowano"] = true;
        header('Location: dashboard.php');
    } else {
        echo '<p style="color:orange;">Błąd, login lub email są już zajęte.</p>';
    }  
    
    $conn->close();
}
?>