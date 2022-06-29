<?php
    if ( isset( $_POST["archiwizuj_konto_kredytowe"] ) ) {
        $id_konta_kredytowego = $_POST["id_konta_kredytowego"];
        if ( $conn->connect_error ) {
            die( "Błąd połączenia: " . $conn->connect_error );
        }
        $sql3 = 'UPDATE konta_kredytowe set archiwum=1 where id="'.$id_konta_kredytowego.'"';
        if ( $conn->query( $sql3 ) === TRUE ) {} else {
            echo "Error: " . $sql3 . "<br>" . $conn->error . "<br>";
        }
    }
    if ( isset( $_POST["przywroc_konto_kredytowe"] ) ) {
        $id_konta_kredytowego = $_POST["id_konta_kredytowego"];
        if ( $conn->connect_error ) {
            die( "Błąd połączenia: " . $conn->connect_error );
        }
        $sql3 = 'UPDATE konta_kredytowe set archiwum=0 where id="'.$id_konta_kredytowego.'"';
        if ( $conn->query( $sql3 ) === TRUE ) {} else {
            echo "Error: " . $sql3 . "<br>" . $conn->error . "<br>";
        }
    }
?>